<?php
if(isset($_POST['settingsform'])){
    //add_option( 'my_example_title', 'my_example_value', '', 'yes' );
    $settings = array(
        "archive-page-view-type"=> $_POST['ViewType'],
        "box-shadow" => $_POST['top'] . 'px ' . $_POST['left'] . 'px ' . $_POST['blur'] .'px ' . $_POST['spread'] . 'px ' . $_POST['colorcode'],
        "title-font-size"=> $_POST['titlefontsize'] . 'px',
        "text-font-size"=> $_POST['textfontsize'] . 'px',
        "item-bg-color"=> $_POST['itembgcolor'],
        "button-style"=> array(
            "buttonbg" => $_POST['buttonbg'],
            "buttonborder" => $_POST['buttonborder'] . 'px',
            "buttonbordercolor" => $_POST['buttonbordercolor'],
            "buttotextcolor" => $_POST['buttontextcolor'],
            "buttontextsize" => $_POST['buttontextsize'] . 'px'
        ),
        "button-hover-style"=> array(
            "buttonhoverbg" => $_POST['buttonhoverbg'],
            "buttonhoverborder" => $_POST['buttonhoverborder'] . 'px',
            "buttonhoverbordercolor" => $_POST['buttonhoverbordercolor'],
            "buttonhovertextcolor" => $_POST['buttonhovertextcolor'],
            "buttonhovertextsize" => $_POST['buttonhovertextsize'] . 'px'
         )
    );
    $test = update_option( 'services_settings', $settings );
}
?>

<div style="margin-top:100px;margin-left:auto;margin-right:auto;max-width:1000px;">
    <div class="message" style="padding:20px 0px;">
        <?php
            if($test == 1) {
                echo "<div style='color:green;font-size:20px;text-align:center;'>Settings Saved</div>";

            } 
        ?>
    </div>
    <h1>Plugins settings</h1><br>
    <form action="/testwp/wp-admin/edit.php?post_type=service&page=settings" method="post" style="border:1px solid #ceceec;border-radius:5px;padding:0 20px 0px 20px;width:100%;float:left">
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;">
            <label style="font-size:15px;margin-right:10px;"><b>Select the archive page view type</b> </label>	
            <select name="ViewType" id="ViewType" style="padding:10px 40px 10px 10px;">
                <option>Select Services View Type</option>
                <option value="list">List</option>
                <option value="grid">Grid</option>
                <option value="card">Cards</option>
            </select>
        </div>
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;width:100%;float:left">
            <label style="font-size:15px;margin-right:10px;float:left;"><b>Apply Box Shadow</b> </label>	
            <div style="width:140px;float:left;margin-right:10px;"><small>Top</small><input type="number" name="top" id="top" style="padding:10px 10px 10px 10px;width:140px;" placeholder="0"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Left</small><input type="number" name="left" id="left" style="padding:10px 10px 10px 10px;width:140px" placeholder="0"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Blur</small><input type="number" name="blue" id="blue" style="padding:10px 10px 10px 10px;width:140px" placeholder="0"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Spread</small><input type="number" name="spread" id="spread" style="padding:10px 10px 10px 10px;width:140px;" placeholder="0 "></div>
            <div style="width:140px;float:left;"><small>Color</small><input type="text" name="colorcode" id="colorcode" style="padding:10px 10px 10px 10px;width:140px;" placeholder="#ffffff"></div>
        </div>
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;width:100%;float:left">
            <label style="font-size:15px;margin-right:10px;"><b>Title font Size</b> </label>	
            <input type="number" name="titlefontsize" id="titlefontsize" style="padding:10px 10px 10px 10px;" placeholder="25">
        </div>
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;width:100%;float:left">
            <label style="font-size:15px;margin-right:10px;"><b>Text Font Size</b> </label>	
            <input type="number" name="textfontsize" id="textfontsize" style="padding:10px 10px 10px 10px;" placeholder="18">
        </div>
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;width:100%;float:left">
            <label style="font-size:15px;margin-right:10px;"><b>Grid, List, Card Item Background Color</b> </label>	
            <input type="text" name="itembgcolor" id="itembgcolor" style="padding:10px 10px 10px 10px;" placeholder="#ffffff">
        </div>
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;width:100%;float:left">
            <div style="width:140px;float:left;margin-right:10px;"><label style="font-size:15px;margin-right:10px;"><b>Button Style</b> </label></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Background Color</small><input type="text" name="buttonbg" id="buttonbg" style="padding:10px 10px 10px 10px;width:100%;" placeholder=" #000000"></div>	
            <div style="width:140px;float:left;margin-right:10px;"><small>Border Width</small><input type="number" name="buttonborder" id="buttonborder" style="padding:10px 10px 10px 10px;width:100%" placeholder="1"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Border Color</small><input type="text" name="buttonbordercolor" id="buttonbordercolor" style="padding:10px 10px 10px 10px;width:100%" placeholder="#000000"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Text Color</small><input type="text" name="buttontextcolor" id="buttontextcolor" style="padding:10px 10px 10px 10px;width:100%" placeholder="#ffffff"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Text Size</small><input type="number" name="buttontextsize" id="buttontextsize" style="padding:10px 10px 10px 10px;width:100%" placeholder="20">	</div>
        </div>	
        <div class="field-group" style="border-bottom:1px solid #cecece;padding:20px 0px;width:100%;float:left">
            <div style="width:140px;float:left;margin-right:10px;"><label style="font-size:15px;margin-right:10px;"><b>Button Hover Style</b> </label></div>	
            <div style="width:140px;float:left;margin-right:10px;"><small>Hover Background Color</small><input type="text" name="buttonhoverbg" id="buttonhoverbg" style="padding:10px 10px 10px 10px;width:100%;" placeholder="#ffffff"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Hover Border Width</small><input type="number" name="buttonhoverborder" id="buttonhoverborder" style="padding:10px 10px 10px 10px;width:100%" placeholder="1"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Hover Border Color</small><input type="text" name="buttonhoverbordercolor" id="buttonhoverbordercolor" style="padding:10px 10px 10px 10px;width:100%" placeholder="#000000"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Hover Text Color</small><input type="text" name="buttonhovertextcolor" id="buttonhovertextcolor" style="padding:10px 10px 10px 10px;width:100%;" placeholder="#00000"></div>
            <div style="width:140px;float:left;margin-right:10px;"><small>Hover Text Size</small><input type="number" name="buttonhovertextsize" id="buttonhovertextsize" style="padding:10px 10px 10px 10px;width:100%" placeholder="20">	</div>
        </div>	
        
        <div class="field-group" style="padding:20px 0px;width:100%;float:left">
            <input type="submit" value="Save" name="settingsform" class="button button-primary" style="padding:8px 10px 10px 10px;width:100%;font-size:20px;">
        </div>
    </form>
</div>