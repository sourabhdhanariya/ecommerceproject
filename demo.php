<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- <body>
    <script>
        for(const i=0;i<10;i++){

        }
        console.log(i);
    </script> -->
    <?php 
        //simple method 
        // $i=5;
        // echo $i*1,$i*2,$i*3,$i*4,$i*5, $i*6, $i*7, $i*8,$i*9,$i*10;
        // use while loops 

        // $i=1;
        // $j=3;
        // while($i<11)
        // {
    
        //     echo $i*$j;
        //     $i++;
        // }            
       
       
        // use without while loops 
           
        // $i=3;
        //     $j=4;
        //     if($i<$j)
        //     {         
        //         echo  $i*$j;
        //     }
        //     $i++;
        

function numbers($n,$i,$m)
{
    if ($n<=$i)
    {
    //    echo $n*$m."  <br>";
       echo "$m x $n = ". $n*$m."  <br>";
       
       numbers($n+1,$i,$m);
    }

}

numbers(1,10,6);
     ?>

</body>
</html>