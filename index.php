<?php
$pageTitle= 'List';
include 'header.php';
include 'constants.php';
?>
<a href="razhod.php">Insert new cost</a>
<form method="get">
<div><select name="group">
<option value=0>All</option>
<?php foreach($groups as $key=>$value){
echo '<option value="'.$key.'">'.$value.'</option>';
}?>
</select>
<input type="submit" value="Filter">
</div>
</form>

<table border=5>
<tr>
<td>Date</td>
<td>Name</td>
<td>Sum</td>
<td>Type</td>
</tr>
<?php
if(file_exists('info.txt')){//ако файла съществува се изпълнява
$result= file('info.txt');//вкарва информация във файла
$totalSum=0;
foreach ($result as $value){
$columns= explode('!',$value);//разделя информацията в колоните в таблицата

if((int)$columns[3]==$_GET['group']||$_GET['group']==0){//показват се само разходите за избран филтър и тяхната сума
$totalSum=$totalSum+$columns[2];
echo '<tr>
<td>'.$columns[0].'</td>
<td>'.$columns[1].'</td>
<td>'.number_format($columns[2], 2,'.','').'</td>
<td>'.$groups[trim($columns[3])].'</td>
</tr>';
}}
echo '<tr><td>----</td><td>----</td><td>'.number_format($totalSum, 2,'.','').'</td><td>-----</td></tr>';
}
?>
</table>

<?php
include 'footer.php';
?>
