<?php 
$provinceRepository = new ProvinceRepository();
$provinces = $provinceRepository->getAll();
$districts = [];
$wards = [];
$selected_ward = $customer->getWard();
$selected_province_id = null;
$selected_district_id = null;
$selected_ward_id = null;
$shipping_fee = 0;
if (!empty($selected_ward)) {
    $selected_ward_id = $selected_ward->getId();
    $selected_district = $selected_ward->getDistrict();
    $selected_district_id = $selected_district->getId();
    $selected_province = $selected_district->getProvince();
    $selected_province_id = $selected_province->getId();
    $districts = $selected_province->getDistricts();
    $wards =  $selected_district->getWards();
    $shipping_fee = $selected_province->getShippingFee();
}
 ?>