<?php

class CronController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $game = array();

        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('cron','tournament','stack','odds','results','xml','test', 'getresult'),//
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionCron()
        {
            $u_id = Yii::app()->user->id;
            $isAdmin = array_key_exists($u_id, $this->admin);

            if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
                
                $time = date("H:i",time());
//                $time = '02:45';//For stack
//                $time = '03:15';//For odds
//                $time = '07:15';//For xml
//                $time = '07:02';//For results

                if($time>'02:30' && $time<'03:00') //Stack fill
                {
                    $cron = Cron::model()->findByAttributes(array('flag'=>'stack_fill'));

                    if( strtotime($cron->cron_time) < strtotime(date("Y-m-d",time())." 02:30") )
                    {
                        $cron->cron_time = date("Y-m-d H:i:s", time());
                        $cron->update();
                        $this->actionStack();
                    }
                }
                else if($time>'14:30' && $time<'15:00') //Stack fill
                {
                    $cron = Cron::model()->findByAttributes(array('flag'=>'stack_fill'));

                    if( strtotime($cron->cron_time) < strtotime(date("Y-m-d",time())." 14:30") )
                    {
                        $cron->cron_time = date("Y-m-d H:i:s", time());
                        $cron->update();
                        $this->actionStack();
                    }
                }
                else if( ($time>'03:00' && $time<'07:00') || ($time>'15:00' && $time<'19:00') ) //Odds get
                {
                    $this->actionOdds();
                }
                else if ( ($time>'07:00' && $time<'07:03') || ($time>'19:00' && $time<'19:03')) //Result get
                {
                    $this->actionResults();
                }
                else if($time>'08:00' && $time<'08:30') //XML Generate
                {
                    $cron = Cron::model()->findByAttributes(array('flag'=>'xml_fill'));

                    if( strtotime($cron->cron_time) < strtotime(date("Y-m-d",time())." 08:00") )
                    {
                        $cron->cron_time = date("Y-m-d H:i:s", time());
                        $cron->update();
                        $this->actionXml();
                    }
                }
                else if($time>'20:00' && $time<'20:30') //XML Generate
                {
                    $cron = Cron::model()->findByAttributes(array('flag'=>'xml_fill'));

                    if( strtotime($cron->cron_time) < strtotime(date("Y-m-d",time())." 20:00") )
                    {
                        $cron->cron_time = date("Y-m-d H:i:s", time());
                        $cron->update();
                        $this->actionXml();
                    }
                }
            
            } else {
                die('Access forbidden!');
            }
            
            exit();
        }

//        Cron job 1
//        Action who populate tournament
        public function actionTournament()
        {
            $u_id = Yii::app()->user->id;
            $isAdmin = array_key_exists($u_id, $this->admin);

            if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
                
                $criteria1 = new CDbCriteria();
                $criteria1->addCondition('active = :active');
                $criteria1->params[":active"] = 1;
                $sports = Sport::model()->findAll($criteria1);

                foreach ($sports as $sport) {
                    $this->tournamentPopulate($sport);
                }
            
            } else {
                die("Access forbidden!");
            }
            
            exit();
        }
        
//Populate tournaments with links from given sport
        public function tournamentPopulate($sport)
        {
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($sport->link);
            $htmlTable = $htmlAll->find('div#divOfferTarget');

            foreach ($htmlTable[0]->find('td a') as $tournament_a) {
                $tournament_name = trim($tournament_a->innertext);
                $tournament_link = $tournament_a->href;

                $criteria2 = new CDbCriteria();
                $criteria2->addCondition('name = :tournament_name');
                $criteria2->params[":tournament_name"] = $tournament_name;
                $tournament = Tournament::model()->find($criteria2);
                if (!$tournament) {
                    $tournament = new Tournament();
                    $tournament->name = $tournament_name;
                    $tournament->link = "https://www.interwetten.com".$tournament_link;
                    $tournament->active = 0;
                    $tournament->sport_id = $sport->id;
                    $tournament->special = 0;
                    $tournament->save();
                }
            }
        }
        
//        Cron job 2
//        Action who populate stack
        public function actionStack()
        {
            $u_id = Yii::app()->user->id;
            $isAdmin = array_key_exists($u_id, $this->admin);

            if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
                
                $criteria1 = new CDbCriteria();
                $criteria1->addCondition('active = :active');
                $criteria1->params[":active"] = 1;
                $tournaments = Tournament::model()->findAll($criteria1);

                foreach ($tournaments as $tournament) {
                    if ($tournament->special == 1) {
                        $this->specialTournament($tournament);
                    } else {
                        $this->stackPopulate($tournament);
                    }
                }
            
            } else {
                die("Access forbidden!");
            }
            
            exit();
        }
        
//        Special leagues, tournaments
        public function specialTournament($tournament)
        {
            $stack = Stack::model()->findByAttributes(array("link"=>$tournament->link));
            if (!$stack) {
                $stack = new Stack();
                $stack->code = $this->codeGenerator($tournament);
                $stack->link = $tournament->link;
                $stack->opponent;
                $stack->start;
                $stack->data;
                $stack->tournament_id = $tournament->id;
                $stack->cron;
                $stack->cron_time;
                $stack->date_created = date("Y-m-d H:i", time());
                $stack->save();
            }
        }

//Populate stack with links from given tournament
        public function stackPopulate($tournament)
        {
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($tournament->link);
            if ($htmlAll) {
                foreach ($htmlAll->find('div.moreinfo') as $elementAll) {
                    foreach ($elementAll->find('a') as $link) {
                        $match_link = "https://www.interwetten.com".$link->href;
                        $stack = Stack::model()->findByAttributes(array("link"=>$match_link));
                        if (!$stack) {
                            $stack = new Stack();
                            $stack->code = $this->codeGenerator($tournament);
                            $stack->link = $match_link;
                            $stack->opponent;
                            $stack->start;
                            $stack->data;
                            $stack->tournament_id = $tournament->id;
                            $stack->cron;
                            $stack->cron_time;
                            $stack->date_created = date("Y-m-d H:i", time());
                            $stack->save();
                        }
                    }
                }
            }
        }
        
//        Code generator needs improvement
        public function codeGenerator($tournament)
        {
            return $tournament->sport->id.$tournament->id.mt_rand(100000, 999999);
        }

// Cron job 3
//Populating odds. Limit setted
        public function actionOdds()
        {
            $u_id = Yii::app()->user->id;
            $isAdmin = array_key_exists($u_id, $this->admin);

            if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
                
                $criteria1 = new CDbCriteria();
                $criteria1->addCondition('cron = :cron');
                $criteria1->params[":cron"] = 0;
                $criteria1->order = "cron, cron_time, id";
                $criteria1->limit = 5;
                $stacks = Stack::model()->findAll($criteria1);

                if (!$stacks) {
                    $criteria2 = new CDbCriteria();
                    $criteria2->addCondition('cron = :cron');
                    $criteria2->params[":cron"] = 1;
                    $criteria2->order = "cron_time, id";
                    $criteria2->limit = 5;
                    $stacks = Stack::model()->findAll($criteria2);
                }

                foreach ($stacks as $stack) {                
                    if ( isset($stack->start) && ((strtotime($stack->start)+30*24*60*60) < time()) ) {
                        $this->deleteFromStack($stack);
                    } else {
                        $this->saveCronpass($stack);
                        if ($stack->tournament->special==1) {
                            $odds = $this->getSpecialOdds($stack);
                        } else {
                            $odds = $this->getOdds($stack);
                        }
                        
                        if ($odds['teams']) {
                            $this->saveOdds($stack, $odds);
                        } else {
                            $stack->delete();
                        }
                    }
                }
                
            } else {
                die("Access forbidden!");
            }
            
            exit();
        }
        
//        Function for getting odds from special tournaments
        public function getSpecialOdds($stack)
        {
            $this->game = array();
            $sport = $stack->tournament->sport->name;
            $pagesLinks = array();
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($stack->link);
            $htmlTableDivs = $htmlAll->find('table.betTable');
            
            $this->sportSpecialSetTeams($htmlTableDivs);//Set teams
            $this->sportSpecialSetDateTime($htmlAll);//Set date and time
            
            foreach ($htmlTableDivs as $elementDiv) {
                if (trim($elementDiv) != '') {
                    $name = $elementDiv->find('.name');
                    $odds = $elementDiv->find('.odds');
                    $this->game['coefficients'][$name[0]->innertext] = $odds[0]->innertext;
                }
            }
            
            return $this->game;
        }
        
        public function sportSpecialSetTeams($htmlTableDivs)
        {
            $teams_array = array();
            foreach ($htmlTableDivs as $elementDiv) {
                if (trim($elementDiv) != '') {
                    $name = $elementDiv->find('.name');
                    $nameExist = Names::model()->findByAttributes(array('name' => trim($name[0]->innertext)));
                    if ($nameExist) {
                        $teams_array[] = trim($name[0]->innertext);
                    }                    
                }
            }
            
            if (count($teams_array) >= 2) {
                $teams_string = implode(' vs ', $teams_array);
                $this->game['teams'] = $teams_string;
            } else {
                $this->game['teams'] = FALSE;
            }
        }
        
        public function sportSpecialSetDateTime($htmlAll)
        {
            $dateHtml = $htmlAll->find('.offerDate');
            $date_trimmed = trim($dateHtml[0]->innertext);
            $date_array = explode('.', $date_trimmed);
            $day = $date_array[0];
            $month = $date_array[1];
            $year = '20'.$date_array[2];
            $date = $year.'-'.$month.'-'.$day;
            
            $timeHtml = $htmlAll->find('.time2');
            $date_time = $date.' '.trim($timeHtml[0]->innertext);
            
            $this->game['date'] = $date_time;
        }
        
//Get odds for given stack link
        public function getOdds($stack)
        {
            $this->game = array();
            $sport = $stack->tournament->sport->name;
            $pagesLinks = array();
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($stack->link);
            $htmlTableDivs = $htmlAll->find('div.containerContentTable');
            $htmlArray = explode('<div>', trim($htmlTableDivs[0]->innertext));
            
            $this->sportSetHomeGuest($htmlAll);//Set home/guest
            $this->sportSetDateTime($htmlAll);//Set date and time
            
            //All divs one-by-one
            foreach ($htmlArray as $elementDiv)
            {
                if(trim($elementDiv) != '')
                {
                    $parserDiv = new SimpleHTMLDOM;
                    $htmlDiv = $parserDiv->str_get_html($elementDiv);
                    
//                    Now we search in current div to find which game is in this div
                    $htmlElement = $htmlDiv->find('.offertype');
                    $game_type = $htmlElement[0]->find('span');//Will return game type, like handicap, First goal etc.
                    
                    if($sport == "Football")
                    {
                        $this->foodballOdds($htmlDiv, $game_type);
                    }
                    else if($sport == "Tennis")
                    {
                        $this->tennisOdds($htmlDiv, $game_type);
                    }
                    else if($sport == "Ice hockey")
                    {
                        $this->icehockeyOdds($htmlDiv, $game_type);
                    }
                    else if($sport == "Basketball")
                    {
                        $this->basketballOdds($htmlDiv, $game_type);
                    }
                    else if($sport == "Handball")
                    {
                        $this->handballOdds($htmlDiv, $game_type);
                    }
                    else if($sport == "American football")
                    {
                        $this->americanFootballOdds($htmlDiv, $game_type);
                    }
                }
            }
            
            return $this->game;
        }
        
//Save odds into stack in database
        public function saveCronpass($stack)
        {
            $stack->cron = 1;
            $stack->cron_time = date("Y-m-d H:i", time());
            $succ = $stack->update();
            
            return 1;
        }
        
//Save odds into stack in database
        public function saveOdds($stack, $odds)
        {
            $odds_encoded = json_encode($odds['coefficients']);
            
            if ($odds['teams']) {
                if(is_array($odds['teams']))
                {
                    $opponent = implode(" vs ", $odds['teams']);
                }
                else
                {
                    $opponent = $odds['teams'];
                }

                $stack->opponent = $opponent;
                $stack->start = $odds['date'];
                $stack->data = $odds_encoded;
                $stack->cron = 1;
                $stack->cron_time = date("Y-m-d H:i", time());
                $stack->update();
            }
            
            return 1;
        }
        
        public function foodballOdds($htmlDiv, $game_type)
        {
            if(trim($game_type[0]->innertext) == 'Match')
            {
                $this->foodballMatch($htmlDiv, $game_type);
            }
            else if((trim(preg_match('/handicap/',$game_type[0]->innertext)) 
                    || trim(preg_match('/Handicap/',$game_type[0]->innertext)))
                    && preg_match('/:/',$game_type[0]->innertext))
            {
                $this->foodballHandicap($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Double Chance')
            {
                $this->foodballDoubleChance($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'First goal')
            {
                $this->foodballFirstGoal($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'How many goals')
            {
                $this->foodballHowManyGoals($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Time first goal')
            {
                $this->foodballTimeFirstGoal($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'When 1st goal')
            {
                $this->foodballWhenFirstGoal($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'HalfTime')
            {
                $this->foodballHalfTime($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Asian 0 Ball Handicap')
            {
                $this->foodballAsianHandicap($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Half-Time/Full-Time')
            {
                $this->foodballHalfTimeFullTime($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Correct Score')
            {
                $this->foodballCorrectScore($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Goals')
            {
                $this->foodballGoals($htmlDiv, $game_type);
            }
        }
        
        public function tennisOdds($htmlDiv, $game_type)
        {
            if(trim($game_type[0]->innertext) == 'Game')
            {
                $this->tennisGame($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Handicap 1.5 Sets')
            {
                $this->tennisHandicap($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Who wins first Set')
            {
                $this->tennisFirstSet($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Set betting')
            {
                $this->tennisSetBetting($htmlDiv, $game_type);
            }
        }
        
        public function icehockeyOdds($htmlDiv, $game_type)
        {
            if(trim($game_type[0]->innertext) == 'Match')
            {
                $this->icehockeyMatch($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Winning Team')
            {
                $this->icehockeyWinningTeam($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Double Chance')
            {
                $this->icehockeyDoubleChance($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'First goal')
            {
                $this->icehockeyFirstGoal($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'How many goals 0-5/6+')
            {
                $this->icehockeyGoals($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Time first goal')
            {
                $this->icehockeyTimeFirstGoal($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == '1st period')
            {
                $this->icehockeyFirstPeriod($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'How many goals in 1st period')
            {
                $this->icehockeyGoalsFirstPeriod($htmlDiv, $game_type);
            }
        }
        
        public function basketballOdds($htmlDiv, $game_type)
        {
            if(trim($game_type[0]->innertext) == 'Games')
            {
                $this->basketballMatch($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Handicap')
            {
                $this->basketballHandicap($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Over/Under')
            {
                $this->basketballOverUnder($htmlDiv, $game_type);
            }
        }
        
        public function handballOdds($htmlDiv, $game_type)
        {
            if(trim($game_type[0]->innertext) == 'Games')
            {
                $this->handballMatch($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Double Chance')
            {
                $this->handballDoubleChance($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Halftime')
            {
                $this->handballHalftime($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Handicap')
            {
                $this->handballHandicap($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'How many goals')
            {
                $this->handballHowManyGoals($htmlDiv, $game_type);
            }
        }
        
        public function americanFootballOdds($htmlDiv, $game_type)
        {
            if(trim($game_type[0]->innertext) == 'Game')
            {
                $this->americanFootballMatch($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Handicap')
            {
                $this->americanFootballHandicap($htmlDiv, $game_type);
            }
            else if(trim($game_type[0]->innertext) == 'Over/Under')
            {
                $this->americanFootballOverUnder($htmlDiv, $game_type);
            }
        }

        //Set home and guest teams. Can be used in any sport
        public function sportSetHomeGuest($htmlAll)
        {
            $divHtml = $htmlAll->find('.containerHeadline');
            $elementDiv = trim($divHtml[0]->innertext);
            
            $parserDiv = new SimpleHTMLDOM;
            $htmlDiv = $parserDiv->str_get_html($elementDiv);
            $teamsHtml = $htmlAll->find('.head');
            $homeGuestHtml = trim($teamsHtml[0]->innertext);
            
            $homeGuestArray = explode('-', $homeGuestHtml);
            $homeTeam = trim($homeGuestArray[0]);
            $guestTeam = trim($homeGuestArray[1]);
            
            $teamHomeExist = Names::model()->findByAttributes(array('name' => $homeTeam));
            $teamGuestExist = Names::model()->findByAttributes(array('name' => $guestTeam));
            
            if ($teamGuestExist && $teamGuestExist) {
                $this->game['teams']['home'] = $homeTeam;
                $this->game['teams']['guest'] = $guestTeam;
            } else {
                $this->game['teams'] = false;
            }
        }
        
        public function sportSetDateTime($htmlAll)
        {
            $dateHtml = $htmlAll->find('.offerDate');
            $date_trimmed = trim($dateHtml[0]->innertext);
            $date_array = explode('.', $date_trimmed);
            $day = $date_array[0];
            $month = $date_array[1];
            $year = '20'.$date_array[2];
            $date = $year.'-'.$month.'-'.$day;
            
            $timeHtml = $htmlAll->find('.time2');
            $time_array = explode('</var>',$timeHtml[0]->innertext);
            
            $date_time = $date.' '.trim($time_array[1]);
            
            $this->game['date'] = $date_time;
        }
        
        public function foodballMatch($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['match']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['match']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['match']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['match']['2'] = $odds[2]->innertext;
        }
        
        public function foodballHandicap($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['handicap']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['handicap']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['handicap']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['handicap']['2'] = $odds[2]->innertext;
        }
        
        public function foodballDoubleChance($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['double-chance']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['double-chance']['1x'] = $odds[0]->innertext;
            $this->game['coefficients']['double-chance']['x2'] = $odds[1]->innertext;
        }
        
        public function foodballFirstGoal($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['first-goal']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['first-goal']['home'] = $odds[0]->innertext;
            $this->game['coefficients']['first-goal']['guest'] = $odds[1]->innertext;
        }
        
        public function foodballHowManyGoals($htmlDiv, $game_type)
        {
            $this->game['coefficients']['how-many-goals']['label'] = trim($game_type[0]->innertext);
            $odds = $htmlDiv->find('.odds');
            $span_name = $htmlDiv->find('span.name');

            $i = 0;
            foreach ($span_name as $span)
            {
                $label = $span->innertext;
                if($label == trim('3 or more')){ $label = '3+'; }
                else if($label == trim('NO goal')){ $label = '0'; }
                else if($label == trim('1 or more')){ $label = '1+'; }
                else if($label == trim('2 or more')){ $label = '2+'; }
                else if($label == trim('4 or more')){ $label = '4+'; }
                else if($label == trim('5 or more')){ $label = '5+'; }

                $this->game['coefficients']['how-many-goals'][$label] = $odds[$i]->innertext;
                $i++;
            }
        }
        
        public function foodballTimeFirstGoal($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');

            $this->game['coefficients']['time-first-goal']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['time-first-goal']['1-29'] = $odds[0]->innertext;
            $this->game['coefficients']['time-first-goal']['30+'] = $odds[1]->innertext;
        }
        
        public function foodballWhenFirstGoal($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            $this->game['coefficients']['when-first-goal']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['when-first-goal']['1-10'] = $odds[0]->innertext;
            $this->game['coefficients']['when-first-goal']['11-20'] = $odds[1]->innertext;
            $this->game['coefficients']['when-first-goal']['21-30'] = $odds[2]->innertext;
            $this->game['coefficients']['when-first-goal']['31-40'] = $odds[3]->innertext;
            $this->game['coefficients']['when-first-goal']['41-50'] = $odds[4]->innertext;
            $this->game['coefficients']['when-first-goal']['51-60'] = $odds[5]->innertext;
            $this->game['coefficients']['when-first-goal']['61-70'] = $odds[6]->innertext;
            $this->game['coefficients']['when-first-goal']['71-80'] = $odds[7]->innertext;
            $this->game['coefficients']['when-first-goal']['81+'] = $odds[8]->innertext;
        }
        
        public function foodballHalfTime($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['half-time']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['half-time']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['half-time']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['half-time']['2'] = $odds[2]->innertext;
        }
        
        public function foodballAsianHandicap($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['asian-handicap']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['asian-handicap']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['asian-handicap']['2'] = $odds[1]->innertext;
        }
        
        public function foodballHalfTimeFullTime($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['half-full-time']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['half-full-time']['H/H'] = $odds[0]->innertext;
            $this->game['coefficients']['half-full-time']['X/H'] = $odds[1]->innertext;
            $this->game['coefficients']['half-full-time']['G/H'] = $odds[2]->innertext;
            $this->game['coefficients']['half-full-time']['H/X'] = $odds[3]->innertext;
            $this->game['coefficients']['half-full-time']['X/X'] = $odds[4]->innertext;
            $this->game['coefficients']['half-full-time']['G/X'] = $odds[5]->innertext;
            $this->game['coefficients']['half-full-time']['H/G'] = $odds[6]->innertext;
            $this->game['coefficients']['half-full-time']['X/G'] = $odds[7]->innertext;
            $this->game['coefficients']['half-full-time']['G/G'] = $odds[8]->innertext;
        }
        
        public function foodballCorrectScore($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['correct-score']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['correct-score']['1:0'] = $odds[0]->innertext;
            $this->game['coefficients']['correct-score']['0:0'] = $odds[1]->innertext;
            $this->game['coefficients']['correct-score']['0:1'] = $odds[2]->innertext;

            $this->game['coefficients']['correct-score']['2:0'] = $odds[3]->innertext;
            $this->game['coefficients']['correct-score']['1:1'] = $odds[4]->innertext;
            $this->game['coefficients']['correct-score']['0:2'] = $odds[5]->innertext;

            $this->game['coefficients']['correct-score']['2:1'] = $odds[6]->innertext;
            $this->game['coefficients']['correct-score']['2:2'] = $odds[7]->innertext;
            $this->game['coefficients']['correct-score']['1:2'] = $odds[8]->innertext;

            $this->game['coefficients']['correct-score']['3:0'] = $odds[9]->innertext;
            $this->game['coefficients']['correct-score']['3:3'] = $odds[10]->innertext;
            $this->game['coefficients']['correct-score']['0:3'] = $odds[11]->innertext;

            $this->game['coefficients']['correct-score']['3:1'] = $odds[12]->innertext;
            $this->game['coefficients']['correct-score']['4:4'] = $odds[13]->innertext;
            $this->game['coefficients']['correct-score']['1:3'] = $odds[14]->innertext;

            $this->game['coefficients']['correct-score']['3:2'] = $odds[15]->innertext;
            $this->game['coefficients']['correct-score']['2:3'] = $odds[16]->innertext;

            $this->game['coefficients']['correct-score']['4:0'] = $odds[17]->innertext;
            $this->game['coefficients']['correct-score']['0:4'] = $odds[18]->innertext;

            $this->game['coefficients']['correct-score']['4:1'] = $odds[19]->innertext;
            $this->game['coefficients']['correct-score']['1:4'] = $odds[20]->innertext;

            $this->game['coefficients']['correct-score']['4:2'] = $odds[21]->innertext;
            $this->game['coefficients']['correct-score']['2:4'] = $odds[22]->innertext;


            $this->game['coefficients']['correct-score']['4:3'] = $odds[23]->innertext;
            $this->game['coefficients']['correct-score']['3:4'] = $odds[24]->innertext;

            $this->game['coefficients']['correct-score']['5:0'] = $odds[25]->innertext;
            $this->game['coefficients']['correct-score']['0:5'] = $odds[26]->innertext;

            $this->game['coefficients']['correct-score']['5:1'] = $odds[27]->innertext;
            $this->game['coefficients']['correct-score']['1:5'] = $odds[28]->innertext;

            $this->game['coefficients']['correct-score']['5:2'] = $odds[29]->innertext;
            $this->game['coefficients']['correct-score']['2:5'] = $odds[30]->innertext;
        }
        
        public function foodballGoals($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['goals']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['goals']['0'] = $odds[0]->innertext;
            $this->game['coefficients']['goals']['1'] = $odds[1]->innertext;
            $this->game['coefficients']['goals']['2'] = $odds[2]->innertext;
            $this->game['coefficients']['goals']['3'] = $odds[3]->innertext;
            $this->game['coefficients']['goals']['4'] = $odds[4]->innertext;
            $this->game['coefficients']['goals']['5+'] = $odds[5]->innertext;
        }

        public function tennisGame($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $this->game['coefficients']['game']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['game']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['game']['2'] = $odds[1]->innertext;
        }

        public function tennisHandicap($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['handicap-1.5']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['handicap-1.5']['-1.5'] = $odds[0]->innertext;
            $this->game['coefficients']['handicap-1.5']['+1.5'] = $odds[1]->innertext;
        }
        
        public function tennisFirstSet($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['first-set']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['first-set']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['first-set']['2'] = $odds[1]->innertext;
        }

        public function tennisSetBetting($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $this->game['coefficients']['set-score']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['set-score']['2:0'] = $odds[0]->innertext;
            $this->game['coefficients']['set-score']['0:2'] = $odds[2]->innertext;
            $this->game['coefficients']['set-score']['2:1'] = $odds[3]->innertext;
            $this->game['coefficients']['set-score']['1:2'] = $odds[5]->innertext;
        }
        
        public function icehockeyMatch($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['match']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['match']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['match']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['match']['2'] = $odds[2]->innertext;
        }

        public function icehockeyWinningTeam($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['winning-team']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['winning-team']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['winning-team']['2'] = $odds[1]->innertext;
        }
        
        public function icehockeyDoubleChance($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['double-chance']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['double-chance']['1x'] = $odds[0]->innertext;
            $this->game['coefficients']['double-chance']['x2'] = $odds[1]->innertext;
        }
        
        public function icehockeyFirstGoal($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['first-goal']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['first-goal']['home'] = $odds[0]->innertext;
            $this->game['coefficients']['first-goal']['guest'] = $odds[1]->innertext;
        }

        public function icehockeyGoals($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['goals']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['goals']['0-5'] = $odds[0]->innertext;
            $this->game['coefficients']['goals']['6+'] = $odds[1]->innertext;
        }
        
        public function icehockeyTimeFirstGoal($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');

            $this->game['coefficients']['time-first-goal']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['time-first-goal']['1-29'] = $odds[0]->innertext;
            $this->game['coefficients']['time-first-goal']['30+'] = $odds[1]->innertext;
        }
        
        public function icehockeyFirstPeriod($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['first-period']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['first-period']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['first-period']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['first-period']['2'] = $odds[2]->innertext;
        }

        public function icehockeyGoalsFirstPeriod($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['goals-first-period']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['goals-first-period']['0-1'] = $odds[0]->innertext;
            $this->game['coefficients']['goals-first-period']['2+'] = $odds[1]->innertext;
        }

        public function basketballMatch($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['match']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['match']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['match']['2'] = $odds[1]->innertext;
        }
        
        public function basketballHandicap($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['handicap']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['handicap']['-1.5'] = $odds[0]->innertext;
            $this->game['coefficients']['handicap']['+1.5'] = $odds[1]->innertext;
        }
        
        public function basketballOverUnder($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $name = $htmlDiv->find('.name');
            $over = '150';
            foreach ($name as $nm)
            {
                $my_array = explode(' ', $nm->innertext);
                $over = $my_array[0];
            }
                        
            $this->game['coefficients']['over_under']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['over_under']['over'][$over] = $odds[0]->innertext;
            $this->game['coefficients']['over_under']['under'][$over] = $odds[1]->innertext;
        }
        
        public function handballMatch($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['match']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['match']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['match']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['match']['2'] = $odds[2]->innertext;
        }

        public function handballDoubleChance($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['double-chance']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['double-chance']['1x'] = $odds[0]->innertext;
            $this->game['coefficients']['double-chance']['x2'] = $odds[1]->innertext;
        }
        
        public function handballHalfTime($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['half-time']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['half-time']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['half-time']['x'] = $odds[1]->innertext;
            $this->game['coefficients']['half-time']['2'] = $odds[2]->innertext;
        }
        
        public function handballHandicap($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $name = $htmlDiv->find('.name');
            $handicap = '17';
            $handicap1 = '-';
            $handicap2 = '+';
            $my_array = explode('(', $name[0]->innertext);
            
            if(strlen(strstr($my_array[1], '+')) > 0)
            {
                $handicap1 = '+';
                $handicap2 = '-';
            }
            
            $handicap = trim($my_array[1], ' , ), +, -');
            
            $this->game['coefficients']['handicap']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['handicap'][$handicap1.$handicap] = $odds[0]->innertext;
            $this->game['coefficients']['handicap'][$handicap2.$handicap] = $odds[1]->innertext;
        }

        public function handballHowManyGoals($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $name = $htmlDiv->find('.name');
            $over = '46';
            foreach ($name as $nm)
            {
                $my_array = explode(' ', $nm->innertext);
                $over = $my_array[1];
            }
            
            $this->game['coefficients']['how-many-goals']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['how-many-goals']['over'][$over] = $odds[0]->innertext;
            $this->game['coefficients']['how-many-goals']['under'][$over] = $odds[1]->innertext;
        }
        
        public function americanFootballMatch($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
                        
            $this->game['coefficients']['match']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['match']['1'] = $odds[0]->innertext;
            $this->game['coefficients']['match']['2'] = $odds[1]->innertext;
        }
        
        public function americanFootballHandicap($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $name = $htmlDiv->find('.name');
            $handicap = '17';
            $handicap1 = '-';
            $handicap2 = '+';
            $my_array = explode('(', $name[0]->innertext);
            
            if(strlen(strstr($my_array[1], '+')) > 0)
            {
                $handicap1 = '+';
                $handicap2 = '-';
            }
            
            $handicap = trim($my_array[1], ' , ), +, -');
            
            $this->game['coefficients']['handicap']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['handicap'][$handicap1.$handicap] = $odds[0]->innertext;
            $this->game['coefficients']['handicap'][$handicap2.$handicap] = $odds[1]->innertext;
        }
        
        public function americanFootballOverUnder($htmlDiv, $game_type)
        {
            $odds = $htmlDiv->find('.odds');
            
            $name = $htmlDiv->find('.name');
            $over = '150';
            foreach ($name as $nm) {
                $my_array = explode(' ', $nm->innertext);
                $over = $my_array[0];
            }
                        
            $this->game['coefficients']['over_under']['label'] = trim($game_type[0]->innertext);
            $this->game['coefficients']['over_under']['over'][$over] = $odds[0]->innertext;
            $this->game['coefficients']['over_under']['under'][$over] = $odds[1]->innertext;
        }

//Cron job 4
//Generate xml document
    public function actionXml()
    {
        $u_id = Yii::app()->user->id;
        $isAdmin = array_key_exists($u_id, $this->admin);

        if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
            
            $criteria1 = new CDbCriteria();
            $criteria1->addCondition("active = :active");
            $criteria1->params[':active'] = 1;
            $sports = Sport::model()->findAll($criteria1);

            $xml = '<?xml version="1.0" encoding="utf-8"?>'; 
            $xml .= '<oddsleaders xmlns="http://oddsleaders.com">';

            foreach ($sports as $sport) {
                $xml .= "<sport>";
                $xml .= "<sport_name>".$sport->name."</sport_name>";

                foreach ($sport->tournaments as $tournament) {
                    if ($tournament->active == 1) {
                        if ($tournament->stacks) {
                            $xml .= "<tournament>";
                            $xml .= "<country>".$tournament->country->country."</country>";
                            $xml .= "<tournament_name>".$tournament->name."</tournament_name>";

                            foreach ($tournament->stacks as $stack) {
                                if ($stack->start) {
                                    $xml .= "<game>";

                                    $xml .= "<code>".$stack->code."</code>";
                                    $xml .= "<opponent>".$stack->opponent."</opponent>";
                                    $xml .= "<start>".strtotime($stack->start)."</start>";
                                    $xml .= "<odds>".$stack->data."</odds>";

                                    $xml .= "</game>";
                                }
                            }

                            $xml .= "</tournament>";
                        }
                    }
                }

                $xml .= "</sport>";
            }

            $xml .= '</oddsleaders>'; 

            if (file_put_contents(dirname(Yii::app()->getBasePath())."/xml/odds.xml",$xml)) {
                $sucessfull = true;
            } else {
                $sucessfull = false;
                echo "Prati mejl na admin vednas!";
            }
        
        } else {
            die("Access forbidden!");
        }
        exit();
    }
    
//    Cron job 5
    public function actionResults()
    {
        $u_id = Yii::app()->user->id;
        $isAdmin = array_key_exists($u_id, $this->admin);

        if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
                
            $stacks = Stack::model()->findAllByAttributes(array('end'=>0));

            foreach ($stacks as $game) {
//                if (time() >= strtotime($game->start)+3*60*60) {
                    $teams = $this->getNames($game->opponent);
                    if ($teams && count($teams) == 2) {
                        $parserAll = new SimpleHTMLDOM;
                        $htmlAll = $parserAll->file_get_html($game->tournament->syn_link);
                        foreach ($htmlAll->find('table.league-table tr') as $tableHtmlRow) {
                            $ft = false;
                            $at = false;
                            $fd = false;

                            foreach ($tableHtmlRow->find('td.fd') as $isFinisfed) {
                                if (trim($isFinisfed->innertext) == 'FT') {
                                    $fd = true;
                                }
                            }
                            
                            if ($fd) { //If game is finished
                                
                                foreach ($tableHtmlRow->find('a.scorelink') as $scoreLink) {
                                    $parserLink = new SimpleHTMLDOM;
                                    $htmlLink = $parserLink->file_get_html('http://www.livescore.com'.trim($scoreLink->href));
                                    
                                    $matchDetailsPage = $htmlLink->find('table.match-details tbody tr');
//                                    $matchDetailsPage[0]//This is first row with final score
//                                    $matchDetailsPage[1]//This is second row with half-time score
                                    
                                    //For final score and teams
                                    $homeTeamHtml = $matchDetailsPage[0]->find('th.home span.team');
                                    $homeTeam = trim($homeTeamHtml[0]->innertext);
                                    
                                    $guestTeamHtml = $matchDetailsPage[0]->find('th.awy span.team');
                                    $guestTeam = trim($guestTeamHtml[0]->innertext);
                                    
                                    $finalScoreHtml = $matchDetailsPage[0]->find('th.sco');
                                    $finalScore = trim($finalScoreHtml[0]->innertext);
                                    $finalScoreArray = explode(' - ', $finalScore);
                                    if (count($finalScoreArray) == 2) {
                                        $homeTeamGoals = trim($finalScoreArray[0]);
                                        $guestTeamGoals = trim($finalScoreArray[1]);
                                    }
                                    
//                                    For half-time
                                    $halfTimeGoalsHtml = $matchDetailsPage[1]->find('th.sco');
                                    if ($halfTimeGoalsHtml) {
                                        $halfTimeGoals = trim(trim($halfTimeGoalsHtml[0]->innertext), '()');
                                        $halfTimeArray = explode(' - ', $halfTimeGoals);
                                        if (count($halfTimeArray) == 2) {
                                            $halfTimeHomeGoals = trim($halfTimeArray[0]);
                                            $halfTimeGuestGoals = trim($halfTimeArray[1]);
                                        }
                                    }
                                    
                                    if ($homeTeam == $teams[0]) {
                                        $ft = true;
                                    }
                                    
                                    if ($guestTeam == $teams[1]) {
                                        $at = true;
                                    }
                                    
                                    $resultArray = array(
                                        'half-time' => array(
                                            'team1' => $halfTimeHomeGoals,
                                            'team2' => $halfTimeGuestGoals
                                        ),
                                        'final' => array(
                                            'team1' => $homeTeamGoals,
                                            'team2' => $guestTeamGoals
                                        )
                                    );
                                    
                                    if ($ft && $at) {
                                        $jsonData = json_decode($game->data);
                                        $jsonData->score = $resultArray;
                                        $game->data = json_encode($jsonData);
                                        $game->result = json_encode($resultArray);
                                        $game->end = TRUE;
                                        $game->cron_time = date("Y-m-d H:i:s", time());
                                        $updated = $game->update();
                                    }
                                    
                                }
                            }
                        }
                    }
//                }
            }
            
        } else {
            die("Access forbidden!");
        }
        
        exit();
    }
    
//    Return array of opponents
    public function getNames($opponents)
    {
        $teamsLive = FALSE;
        $teamsInter = explode(' vs ', $opponents);
        
        foreach ($teamsInter as $teamInter) {
            $team = Names::model()->findByAttributes(array('name' => $teamInter));
            
            if ($team) {
                $teamsLive[] = $team->syn;
            }
        }
        
        return $teamsLive;
    }
    
    //Copy to another table and delete from current
    public function deleteFromStack($stack)
    {
        $stackOld = new StackOld();
        
        $stackOld->code = $stack->code;
        $stackOld->link = $stack->link;
        $stackOld->syn_link = $stack->syn_link;
        $stackOld->opponent = $stack->opponent;
        $stackOld->syn = $stack->syn;
        $stackOld->start = $stack->start;
        $stackOld->end = $stack->end;
        $stackOld->data = $stack->data;
        $stackOld->tournament_id = $stack->tournament_id;
        $stackOld->cron = $stack->cron;
        $stackOld->cron_time = $stack->cron_time;
        $stackOld->date_created = $stack->date_created;
        
        $saved = $stackOld->save();
        if ($saved) {
            $stack->delete();
        }
        
        exit();
    }
    
    /**
     * Format numbers, ',' is changed into '.'
     * @param type $value
     * @return type float
     */
    public function formatNumber($value)
    {
        return round(str_replace(',', '.', $value) , 2);
    }
    
    /**
     * Accept game code and return final and half-time score
     * @param type $code
     */
    public function actionGetresult($code=false)
    {
        if ($code) {
            $stack = Stack::model()->findByAttributes(array('code'=>$code));
            echo $stack->result;
        } else {        
            echo $code;
        }
    }

    public function actionTest()
    {
        $u_id = Yii::app()->user->id;
        $isAdmin = array_key_exists($u_id, $this->admin);

        if (($_SERVER['SERVER_ADDR'] == $_SERVER['REMOTE_ADDR']) || $isAdmin) {
            
            $tournament = Tournament::model()->findByPk(88);
            $bla = $this->codeGenerator($tournament);
//            var_dump($bla);
//            exit();
            
            //$link = "http://www.flashscore.com/soccer/england/premier-league/results/";
            $link = "http://api.oddsleaders.com";
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($link);
            echo $htmlAll;
            exit();
            $htmlTableDivs = $htmlAll->find('div.containerContentTable');
    //        $htmlArray = explode('<div>', trim($htmlTableDivs[0]->innertext));

            //All divs one-by-one
    //        foreach ($htmlArray as $elementDiv)
    //        {
    //            if(trim($elementDiv) != '')
    //            {
    //                $parserDiv = new SimpleHTMLDOM;
    //                $htmlDiv = $parserDiv->str_get_html($elementDiv);
    //
    ////                Now we search in current div to find which game is in this div
    //                $htmlElement = $htmlDiv->find('.offertype');
    //                $game_type = $htmlElement[0]->find('span');//Will return game type, like handicap, First goal etc.
    //
    //                $this->americanFootballOdds($htmlDiv, $game_type);
    //            }
    //        }
        } else {
            die("Access forbidden!");
        }
    }
    
}