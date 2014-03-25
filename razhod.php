<?php
$pageTitle= 'Insert cost';
include 'header.php';
include 'constants.php';

if($_POST){
$name=trim($_POST['name']);//маха всички разстояния между думите
$name=str_replace('!','',$name);//заменя ! с празен интервал
$sum=floatval(str_replace(',','.',$_POST['sum']));//заменя , с . при въвеждането на числата
$selectedGroup=(int)$_POST['group'];//нормализация на select
$error=false;
if(mb_strlen($name)<4){
echo '<p>The name is too short.</p>';
$error=true;
}
if($sum<0){
echo '<p>Invalid cost</p>';
$error=true;
}
if(!array_key_exists($selectedGroup,$groups)){//проверява дали съществува ключ за даден масив
echo '<p>Invalid group</p>';
$error=true;
}
if(!$error){//ако няма грешка се изпълнява
$result=date('d-m-Y').'!'.$name.'!'.$sum.'!'.$selectedGroup."\n";
if(file_put_contents('info.txt',$result,FILE_APPEND)){//FILE_APPEND вкарва и този запис като следващ, ако го няма-записа ще се презапише
echo 'Successful record.';
}
}}
?>
<a href="index.php">List</a>
<form method="post">
<div>Name<input type="text" name="name"></div>
<div>Sum<input type="text" name="sum"></div>
<div>Type<select name="group">
<?php foreach($groups as $key=>$value){
echo '<option value="'.$key.'">'.$value.'</option>';
}?>
</select></div>
<div><input type="submit" value="Insert"></div></form>

<?php>
include 'footer.php';
?>
