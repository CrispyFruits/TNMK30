  <?php 
    include 'menu.txt'; 

    $connection = mysqli_connect("mysql.itn.liu.se","lego","","lego");
    if (!$connection) {
      die('MySQL connection error');
    }
     
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);
  ?>

<?php
  function in_array_r($needle, $haystack, $strict = false) {
      foreach ($haystack as $item) {
          if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
              return true;
          }
      }

      return false;
  }

  function searchForId($id, $array) {
    foreach ($array as $key => $val) {
        if ($val['uid'] === $id) {
            return $key;
        }
    }
    return null;
 }
?>


  <main>
  <?php 

    $query = mysqli_query($connection, "SELECT parts.PartID, colors.ColorID, inventory.Quantity FROM sets, collection, parts, colors, inventory WHERE inventory.ItemID=parts.PartID AND sets.SetID=collection.SetID AND sets.SetID=inventory.SetID AND inventory.ColorID=colors.ColorID LIMIT 10");
    //$partArray[];

    print("<table>\n<tr>");
    print("<th>Quantity</th><th>Part ID</th> <th>Color ID</th></tr>\n");
    
    
    while($row = mysqli_fetch_array($query)) {
      
      
      $quantity = $row['Quantity'];
      //$partName = $row['Partname'];
      $partID = $row['PartID'];
      //$colorName = $row['Colorname'];
      $colorID = $row['ColorID'];
      //$category = $row['Categoryname'];
      
      if(in_array_r($partID, $partArray)){
        //echo "ass";
      }

      $partArray[] = array(
        "PartID" => $partID,
        "ColorID" => $colorID,
        "Quantity" => $quantity
      );
      
     
      
      /*$prefix = "http://www.itn.liu.se/~stegu76/img.bricklink.com/";
        
      $imagesearch = mysqli_query($connection, "SELECT * FROM images, parts WHERE ItemTypeID='P' AND images.ItemID=parts.PartID ORDER BY ItemID LIMIT 10");
      

      $imageinfo = mysqli_fetch_array($imagesearch);
      if($imageinfo['has_jpg']) { 
        $filename = "P/$colorID/$partID.jpg";
      } 
      else if($imageinfo['has_gif']) { 
        $filename = "P/$colorID/$partID.gif";
      } 
      else { 
        $filename = "noimage_small.png";
      }

      $picSource = $prefix . $filename;*/

      print("<tr><td class='centerTd'>$quantity</td><td>$partID</td> <td class='centerTd'>$colorID</td></tr>");

    }

      print("</table>");
      
    
  ?>
  </main>

</body>

</html>



<!--$partArray = array(
      array(
        "PartID" => "3957",
        "ColorID" => 11,
        "Quantity" =>1
      ),
      array(
        "PartID" => "3957",
        "ColorID" => 9,
        "Quantity" =>1
      ),
      array(
        "PartID" => "4490",
        "ColorID" => 11,
        "Quantity" =>2
      )
    ); 

    print($partArray[0]['PartID']);
    
    $partArray[$i] = array(
        array(
          "PartID" => $partID,
          "ColorID" => $colorID,
          "Quantity" => $quantity
        );
      
      $i++;
    
    -->

<!-- <div>Font made from <a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>is licensed by CC BY 3.0</div> -->
