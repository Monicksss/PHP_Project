<?php

require './config/function.php';


$paraRestultId = checkParamId('id');

if(is_numeric($paraRestultId)){

    $productId= validate($paraRestultId);

    $product = getById('products', $productId);

    if($product['status'] == 200)
    {
      $response = delete('products',$productId);
      if($response)

      {
        $deleteImage = "../".$product['data']['image'];
        if(file_exists($deleteImage))
        {
          unlink($deleteImage);
        }
        redirect('products.php','product Deleted successfully' );
      }
      else{
        redirect('products.php','something went wrong!' );
      }
    }
    else{
        redirect('products.php',$product['message'] );
    }
    

}else{
   redirect('products.php','Something Went Wrong.');
}



?>