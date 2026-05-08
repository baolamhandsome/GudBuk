<?php
//render 3 thành phần chung cho mọi view của từng url 
$this->renderView('fixed_components/header');
$this->renderView('fixed_components/footer');
$this->renderView('fixed_components/sidebar');
// render phần riêng (phần content) cho từng url một

// ta đã nhúng view từ /parts/user -> main layout