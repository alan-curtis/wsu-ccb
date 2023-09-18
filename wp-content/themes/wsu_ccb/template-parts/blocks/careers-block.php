<div class="career-block-section">
<div class="container">
    <h3>
        <?= get_field('title');?>
    </h3>
    <div class="copy">
    <?= get_field('copy');?>
    </div>
<div class="row gx-2 gx-md-3">

<?php $select = get_field('career_select'); 
 
 if( $select == 'Onet' ) {
$rows = get_field('career_repeater');
if( $rows ) {

    foreach( $rows as $row ) {
?>


<?php
$soc_code = $row['soc_code'];
$title = $row['career_title'];
$credit = $row['credit'];
$remote_url ='https://services.onetcenter.org/ws/mnm/careers/' . $soc_code . '/job_outlook';
$id_token = 'YnVzaW5lc3Nfd3N1OjQyMjdwa3Q=';
$apiResponse = wp_remote_post($remote_url,[
    'method'    => 'GET',
    'headers'  => [
        'Authorization' => 'Basic ' . $id_token,
        'client' => 'business_wsu',
        'Content-Type' => 'application/json',
    ],
]

);
$apiBody =  wp_remote_retrieve_body( $apiResponse);
$fileContents = str_replace(array("\n", "\r", "\t"), '', $apiBody);
$fileContents = trim(str_replace('"', "'", $fileContents));
$simpleXml = simplexml_load_string ($fileContents );
$json = json_encode($simpleXml); // Remove // if you want to store the result in $json variable
$arrOutput = json_decode($json, TRUE);
$salary = $arrOutput['salary']['annual_median'];
?>

<?php if( !empty( $soc_code ) ): ?>

<div class="col-lg-4 col-6 career-container">
   
        <div class="career-container__inner">
        <h4><?= $title; ?></h4>
        <div class="salary"><?= '$'. number_format_i18n($salary);?> Median Salary </div>
        <div class="credit"><?= $credit; ?></div>  
        </div>

 </div>
<?php endif;?>


<?php } ?>

<?php } 
 }
elseif( $select == 'Manual' ) { 
    $rowss = get_field('career_manual_repeater');
    if( $rowss ) {

        foreach( $rowss as $rows ) {

            $salary = $rows['median_salary'];
            $title = $rows['career_title'];
            $credit = $rows['credit'];
    ?>



<div class="col-lg-4 col-6 career-container">
   
        <div class="career-container__inner">
        <h4><?= $title; ?></h4>
        <div class="salary"><?= $salary;?>  </div>
        <div class="credit">
            <a href="<?= $credit['url']; ?>" target="<?= $credit['target']; ?>"><?= $credit['title']; ?></a></div>  
        </div>

 </div>


 <?php 
        }  
    }
}
?>

<?php 
 ?>
</div>
</div>
</div>