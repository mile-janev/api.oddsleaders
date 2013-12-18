<h1>Help</h1>
<div id="questions">
    
	<a href="" class="button grey header">1. Newest XMLs</a>
        <div class="answer">
            1.1 Newest XML with odds for next 7 days is located in 
                <a href="http://api.oddsleaders.com/xml/odds.xml" target="_blank">http://api.oddsleaders.com/xml/odds.xml</a>. <br /><br />
            1.2 Newest XML with results and latest odds before starting the game is located in 
                <a href="http://api.oddsleaders.com/xml/results.xml" target="_blank">http://api.oddsleaders.com/xml/results.xml</a>. <br /><br />
            1.3 Newest XML with odds for unlimited next time with newest odds in our database is located in
                <a href="http://api.oddsleaders.com/xml/odds-all.xml" target="_blank">http://api.oddsleaders.com/xml/odds-all.xml</a>. <br /><br />
            1.4 Newest XML with results from past 30 days is located in
                <a href="http://api.oddsleaders.com/xml/results-month.xml" target="_blank">http://api.oddsleaders.com/xml/results-month.xml</a>. <br /><br />
        </div>
        
	<a href="" class="button grey header">2. Getting Odds for match by own wish</a>
	<div class="answer">
            All games have unique code in our database. Using this code you can reach whatever you want for that game.
                We create few functions for this and will explain you how to use it.<br /><br />
            At start, we need to point that:<br />
                -All functions accept some GET parameter.<br />
                -Any function will return you encoded json object, or FALSE if not found that record in our database.<br /><br />
            2.1 Using any function <br /><br />
            Example for sending params and reciving response:<br />
            $encoded_json_object = file_get_contents('url_where_parameter_will_be_sended'.&code=123456789);<br />
            After this you can decode this object with json_decode($encoded_json_object).<br />
            <strong>Note!</strong> FALSE will be returned if record for this request is not found.            
	</div>
        
	<a href="" class="button grey header">3. Getting Results for match by own wish</a>
	<div class="answer">
            
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