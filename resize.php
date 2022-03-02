<?php
function load_image($filename, $type) {
    if( $type == IMAGETYPE_JPEG ) {
        $image = imagecreatefromjpeg($filename);
    }
    elseif( $type == IMAGETYPE_PNG ) {
        $image = imagecreatefrompng($filename);
    }
    elseif( $type == IMAGETYPE_GIF ) {
        $image = imagecreatefromgif($filename);
    }
    return $image;
}

function resize_image($new_width, $new_height, $image, $width, $height) {
    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    return $new_image;
}

function resize_image_to_width($new_width, $image, $width, $height) {
    $ratio = $new_width / $width;
    $new_height = $height * $ratio;
    return resize_image($new_width, $new_height, $image, $width, $height);
}

function resize_image_to_height($new_height, $image, $width, $height) {
    $ratio = $new_height / $height;
    $new_width = $width * $ratio;
    return resize_image($new_width, $new_height, $image, $width, $height);
}

function scale_image($scale, $image, $width, $height) {
    $new_width = $width * $scale;
    $new_height = $height * $scale;
    return resize_image($new_width, $new_height, $image, $width, $height);
}


function save_image($new_image, $new_filename, $new_type='jpeg', $quality=80) {
    if( $new_type == 'jpeg' ) {
        imagejpeg($new_image, $new_filename, $quality);
     }
     elseif( $new_type == 'png' ) {
        imagepng($new_image, $new_filename);
     }
     elseif( $new_type == 'gif' ) {
        imagegif($new_image, $new_filename);
     }
}


/* Testing the above code */

$file_name_time = time();


if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $tmp_ext = explode('.', $_FILES['image']['name']);
    $file_ext = end($tmp_ext);

    $expensions= array("jpeg","jpg","png");
    if(file_exists($file_name)) {
      echo "Sorry, file already exists.";
      }
    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    // if($file_size > 2097152){
    //    $errors[]='File size must be excately 2 MB';
    // }

    if(empty($errors)==true){
        $file_naME_EXT = "images/".$file_name_time.".".$file_ext;
      move_uploaded_file($file_tmp,$file_naME_EXT);

$zip_filename = 'images/'.time().'.zip';

$filename = $file_naME_EXT;
list($width, $height, $type) = getimagesize($filename);

$old_image = load_image($filename, $type);

$zip = new ZipArchive();
if (file_exists($zip_filename)) {
    unlink($zip_filename);
}

if ($zip->open($zip_filename, ZIPARCHIVE::CREATE) != TRUE) {
    die ("Could not open archive");
}


$files= [];

$number = $_POST['number'];
if($number==""){
    $number = 1;
}
if($number<1){
    $number = 1;
}

$quality = $_POST['quality'];
if($quality==""){
    $quality = 10;
}
if($quality<10){
    $quality = 10;
}

for ($i=1;$i<=$number;$i++) {
    $mid_witdth = $width + rand(10, 20);
    $mid_height = $height + rand(10, 20);

    $new_image = resize_image($mid_witdth, $mid_height, $old_image, $width, $height);
    // $quality = rand(10,20);
    $new_image_name = 'images/'.$mid_witdth.'x'.$mid_height.'-'.basename($filename);
    save_image($new_image, $new_image_name, 'jpeg', $quality);

    $zip->addFile($new_image_name);
    array_push($files,$new_image_name);
}

$zip->close();

foreach($files as $file){
    unlink($file);
}

unlink($filename);


header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($zip_filename) . "\""); 
readfile($zip_filename); 

}

else{
 print_r($errors);
}

}else{
    header("Location: ./");
}
