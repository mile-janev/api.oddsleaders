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
				'actions'=>array('tournamentstack','odds','xmlgenerate','test'),//
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
//        Cron job 1
//        Action who populate tournament and stack. Run at least 30min-1h BEFORE populating odds action
        public function actionTournamentstack()
        {
            $criteria1 = new CDbCriteria();
            $criteria1->addCondition('active = :active');
            $criteria1->params[":active"] = 1;
            $sports = Sport::model()->findAll($criteria1);
            
            foreach ($sports as $sport)
            {
                $this->tournamentPopulate($sport);
            }
            
            $criteria2 = new CDbCriteria();
            $criteria2->addCondition('active = :active');
            $criteria2->params[":active"] = 1;
            $tournaments = Tournament::model()->findAll($criteria2);
            
            foreach ($tournaments as $tournament)
            {
                $this->populateStack($tournament);
                
            }
            
            exit();
        }
        
//Populate tournaments with links from given sport
        public function tournamentPopulate($sport)
        {
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($sport->link);
            $htmlTable = $htmlAll->find('div#divOfferTarget');

            foreach ($htmlTable[0]->find('td a') as $tournament_a)
            {
                $tournament_name = trim($tournament_a->innertext);
                $tournament_link = $tournament_a->href;

                $criteria2 = new CDbCriteria();
                $criteria2->addCondition('name = :tournament_name');
                $criteria2->params[":tournament_name"] = $tournament_name;
                $tournament = Tournament::model()->find($criteria2);
                if(!$tournament)
                {
                    $tournament = new Tournament();
                    $tournament->name = $tournament_name;
                    $tournament->link = "https://www.interwetten.com".$tournament_link;
                    $tournament->active = 1;
                    $tournament->sport_id = $sport->id;
                    $tournament->save();
                }
            }
        }

//Populate stack with links from given tournament
        public function populateStack($tournament)
        {
            $parserAll = new SimpleHTMLDOM;
            $htmlAll = $parserAll->file_get_html($tournament->link);
            foreach($htmlAll->find('div.moreinfo') as $elementAll)
            {
                foreach ($elementAll->find('a') as $link)
                {
                    $match_link = "https://www.interwetten.com".$link->href;

                    $stack = Stack::model()->findByAttributes(array("link"=>$match_link));
                    if(!$stack)
                    {
                        $stack = new Stack();
                        $stack->link = $match_link;
                        $stack->opponent;
                        $stack->start;
                        $stack->data;
                        $stack->tournament_id = $tournament->id;
                        $stack->cron;
                        $stack->cron_time;
                        $stack->date_created = new CDbExpression('NOW()');
                        $stack->save();
                    }
                }
            }
        }
        
// Cron job 2
//Get odds. Add this as link in admin part
        public function actionOdds()
        {
            $criteria1 = new CDbCriteria();
            $criteria1->addCondition('cron = :cron');
            $criteria1->params[":cron"] = 0;
            $criteria1->order = "cron, cron_time, id";
            $criteria1->limit = 2;
            $stacks = Stack::model()->findAll($criteria1);
            
            if(!$stacks)
            {
                $criteria2 = new CDbCriteria();
                $criteria2->addCondition('cron = :cron');
                $criteria2->params[":cron"] = 1;
                $criteria2->order = "cron_time, id";
                $criteria2->limit = 2;
                $stacks = Stack::model()->findAll($criteria2);
            }
            
            foreach ($stacks as $stack)
            {                
                $this->saveCronpass($stack);
                $odds = $this->getOdds($stack);
                $this->saveOdds($stack, $odds);
            }
            
            exit();
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
            $this->foodballSetDateTime($htmlAll);//Set date and time
            
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
                }
            }
            
            return $this->game;
        }
        
//Save odds into stack in database
        public function saveCronpass($stack)
        {
            $stack->cron = 1;
            $stack->cron_time = new CDbExpression('NOW()');
            $succ = $stack->update();
            
            return 1;
        }
//Save odds into stack in database
        public function saveOdds($stack, $odds)
        {
            $odds_encoded = json_encode($odds);
            $opponent = implode("/vs/", $odds['teams']);
            
            $stack->opponent = $opponent;
            $stack->start = $odds['date'];
            $stack->data = $odds_encoded;
            $stack->cron = 1;
            $stack->cron_time = new CDbExpression('NOW()');
            $stack->update();
            
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

        //Set home and guest teams. Can be used in any sport
        public function sportSetHomeGuest($htmlAll)
        {
            $divHtml = $htmlAll->find('.containerHeadline');
            $elementDiv = trim($divHtml[0]->innertext);
            
            $parserDiv = new SimpleHTMLDOM;
            $htmlDiv = $parserDiv->str_get_html($elementDiv);
            $teamsHtml = $htmlAll->find('.head');
            $home_guest_html = trim($teamsHtml[0]->innertext);
            
            $home_guest_array = explode('-', $home_guest_html);
            $home_team = trim($home_guest_array[0]);
            $guest_team = trim($home_guest_array[1]);
            
            $this->game['teams']['home'] = $home_team;
            $this->game['teams']['guest'] = $guest_team;
        }
        
        public function foodballSetDateTime($htmlAll)
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
  
//Cron job 3
//Generate xml document
    public function actionXmlgenerate()
    {
        $criteria1 = new CDbCriteria();
        $criteria1->addCondition("active = :active");
        $criteria1->params[':active'] = 1;
        $sports = Sport::model()->findAll($criteria1);
        
        $xml = '<?xml version="1.0" encoding="utf-8"?>'; 
        $xml .= '<oddsleaders xmlns="http://oddsleaders.com">';
        
        foreach ($sports as $sport)
        {
            $xml .= "<sport>";
            $xml .= "<sport_name>".$sport->name."</sport_name>";
            
            foreach ($sport->tournaments as $tournament)
            {
                $xml .= "<tournament>";
                $xml .= "<tournament_name>".$tournament->name."</tournament_name>";
                
                foreach ($tournament->stacks as $stack)
                {
                    $xml .= "<game>";
                    $xml .= "<odds>".$stack->data."</odds>";
                    $xml .= "</game>";
                }
                
                $xml .= "</tournament>";
            }
            
            $xml .= "</sport>";
        }
        
        $xml .= '</oddsleaders>'; 
 
        if(file_put_contents(dirname(Yii::app()->getBasePath())."/xml/odds.xml",$xml))
        {
            $sucessfull = true;
        }
        else
        {
            $sucessfull = false;
            echo "Prati mejl na admin vednas!";
        }
        
        exit();
    }
    
    public function actionTest()
    {
        $link = "https://www.interwetten.com/en/sportsbook/e/9871485/fenerbahce-fc-barcelona";
        
        $parserAll = new SimpleHTMLDOM;
        $htmlAll = $parserAll->file_get_html($link);
        $htmlTableDivs = $htmlAll->find('div.containerContentTable');
        $htmlArray = explode('<div>', trim($htmlTableDivs[0]->innertext));
        
        //All divs one-by-one
        foreach ($htmlArray as $elementDiv)
        {
            if(trim($elementDiv) != '')
            {
                $parserDiv = new SimpleHTMLDOM;
                $htmlDiv = $parserDiv->str_get_html($elementDiv);

//                Now we search in current div to find which game is in this div
                $htmlElement = $htmlDiv->find('.offertype');
                $game_type = $htmlElement[0]->find('span');//Will return game type, like handicap, First goal etc.

                $this->basketballOdds($htmlDiv, $game_type);
            }
        }
    }
}