<h1>Help</h1>
<div id="questions">
    
        <a href="#" class="button grey header">1. General Information</a>
	<div class="answer">
            All games have unique code in our database. Using this code you can reach whatever you want for that game.
                We create few functions (actions) for this and will explain you how to use it.<br /><br />
            At start, we need to point that:<br />
                -All functions accept some GET parameter.<br />
                -Any function will return you encoded json object, or FALSE if not found that record in our database.<br /><br />
            1.1 Example for sending params and reciving response:<br />
            $encoded_json_object = file_get_contents('url_where_parameter_will_be_sended'.&code=123456789);<br />
            After this you can decode this object with json_decode($encoded_json_object).<br />
            <strong>Note!</strong> FALSE will be returned if record for this request is not found.            
	</div>
    
	<a href="#" class="button grey header">2. Newest XMLs</a>
        <div class="answer">
            2.1 Newest XML with odds for next 7 days is located in 
                <a href="http://api.oddsleaders.com/xml/odds.xml" target="_blank">http://api.oddsleaders.com/xml/odds.xml</a>. <br /><br />
            2.2 Newest XML with results from past 30 days is located in
                <a href="http://api.oddsleaders.com/xml/results.xml" target="_blank">http://api.oddsleaders.com/xml/results.xml</a>. <br /><br />
            2.3 Newest XML with odds for unlimited next time with newest odds in our database is located in
                <a href="http://api.oddsleaders.com/xml/odds-all.xml" target="_blank">http://api.oddsleaders.com/xml/odds-all.xml</a>. <br /><br />
        </div>
        
	<a href="#" class="button grey header">3. Getting Odds for match by own wish</a>
	<div class="answer">
            Getting new odds for match by own wish can be done using some of the folowing actions:<br /><br />
            3.1 <a href="http://api.oddsleaders.com/index.php?r=cron/getodds&code=123456" target="_blank">http://api.oddsleaders.com/index.php?r=cron/getodds&code=123456</a>
                - You will get newest odds from our database for this match. Note that odds are renewed 2-times in day. This is much faster then other functions.<br /><br />
            3.2 <a href="http://api.oddsleaders.com/index.php?r=cron/forceodds&code=123456" target="_blank">http://api.oddsleaders.com/index.php?r=cron/forceodds&code=123456</a>
                - You will get newest odds, but weeknes here is slower executing. Sometimes need 5-6 seconds for this to be executed.<br /><br />
                This is the reason because we recommend using previous function.
	</div>
        
	<a href="#" class="button grey header">4. Getting Results for match by own wish</a>
	<div class="answer">
            Getting new odds for match by own wish can be done using some of the folowing actions:<br /><br />
            3.1 <a href="http://api.oddsleaders.com/index.php?r=cron/getresult&code=123456" target="_blank">http://api.oddsleaders.com/index.php?r=cron/getresult&code=123456</a>
                - You will get newest results from database for this match. Note that results are renewed 2-times in day. This is much faster then other functions.<br /><br />
            3.2 <a href="http://api.oddsleaders.com/index.php?r=cron/forceresults&code=123456" target="_blank">http://api.oddsleaders.com/index.php?r=cron/forceresults&code=123456</a>
                - You will get newest results, but weeknes here is slower executing. Sometimes need 5-6 seconds for this to be executed.<br /><br />
                This is the reason because we recommend using previous function.
	</div>
        
</div>

<?php
    $script = Yii::app()->clientScript;
    $script->registerCoreScript('jquery');
?>
<script type="text/javascript">
	$('#questions a.header').click(function(){
		$(this).next('.answer').slideToggle();
		click = $(this).attr('class');
		if(click == 'button grey')
		{
			$(this).addClass('click');
		}
		else
		{
			$(this).removeClass('click');
		}
		return false;
	});
</script>