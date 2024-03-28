<?php

//4桁のランダムID
//一度出たidは出ないようにする！！！.
function generateid($length = 9 ) {
    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
    $r_str = null;  
  
    for ($i = 0; $i < $length; $i++) {
      //10桁にしないように-1は9出力
        $r_str .= $str[rand(0,count($str) - 1)];
        //.桁の文字列結合
        //0から-1にすることで9個文字が表示される
    }
  
    return $r_str;  //戻り値
  }
  
  
?>