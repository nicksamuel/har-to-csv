<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>HAR to CSV</title>
    </head>
    <body>
        <main>
            
            <h1>Har 2 CSV</h1>
            
            <form method="post" enctype="multipart/form-data">
                Select har to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Har" name="submit">
                <input type="checkbox" name="image_only" /><label>Images only?</label>
            </form>
            
            
            <button type="button" onclick="selectElementContents( document.getElementById('table') );">Highlight table</button>

            <table id="table">
                <tr>
                    <td>Order</td>                    
                    <td>Status</td>
                    <td>HTTP</td>
                    <td>Type</td>
                    <td>DOMAIN</td>
                    <td>Full Name</td>
                    <td>Size (KB)</td>
                    <td>Time (MS)</td>                    
                </tr>
                <?php
                // Read JSON file
$json = file_get_contents($_FILES['fileToUpload']['tmp_name']);

//Decode JSON
$json_data = json_decode($json,true);
$i = 0;
//Print data
foreach($json_data as $json2){
    
    foreach($json2[entries] as $json){
        $i++;
        
        
    $filteredStudent = array_filter($json[response][headers], function($value) {
        $value["name"] = strtolower($value["name"]);
        return $value["name"] == "content-type";
        
    });    
    foreach($filteredStudent as $test){  
        $filetype = $test['value'];        
    }
           
        
        if(!empty($_POST['image_only'])):
            
            if(strpos($filetype, 'image') !== false):                
                else:                
                $i--;
                continue;
            endif;
        endif;        
       ?>
            
            
                <tr>
                    <td>
                        <?php echo $i; ?>
                    </td>                    
                    <td>
                       <?php echo $json[response][status]; ?> 
                    </td>
                    <td>
                    <?php echo $json[request][httpVersion]; ?>
                    </td>
                    <td>
                        <?php echo $filetype; ?>
                    </td>
                    <td>
                        <?php
                            $filteredStudent = array_filter($json[request][headers], function($value) {
                                return $value["name"] == ":authority";
                            });    
                            foreach($filteredStudent as $test){       
                                echo $test['value'];
                            }
                            ?>
                        <?php
                            $filteredStudent = array_filter($json[request][headers], function($value) {
                                $value["name"] = strtolower($value["name"]);
                                return $value["name"] == "host";
                            });    
                            foreach($filteredStudent as $test){       
                                echo $test['value'];
                            }
                            ?>
                    </td>
                    <td><?php echo $json[request][url]; ?> </td>   
                    
                    
                    
                    
                    <td>
                        <?php echo round($json[response][bodySize] / 1000, 1) ?>
                    </td>
                    <td>
                        <?php echo $json[time] ?>
                    </td>                    
                </tr>
                
                <?php       
    
    }
    
}



?>
        </table>
            
            
        </main>        
    </body>
    
    <style>
            body{
                margin:0px;
                font-family:Verdana;
                color:#00a1ff;
            }
            table{
                width:100%;
                
            }
            table td{
                    overflow:hidden;
                    width:10%;
                }
        </style>
        
        <script>
 function selectElementContents(el) {
	var body = document.body, range, sel;
	if (document.createRange && window.getSelection) {
		range = document.createRange();
		sel = window.getSelection();
		sel.removeAllRanges();
		try {
			range.selectNodeContents(el);
			sel.addRange(range);
		} catch (e) {
			range.selectNode(el);
			sel.addRange(range);
		}
	} else if (body.createTextRange) {
		range = body.createTextRange();
		range.moveToElementText(el);
		range.select();
	}
}

</script>
    
</html>
