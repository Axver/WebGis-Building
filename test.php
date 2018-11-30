<html>

 <head>
 
 </head>

 <body>
    <select onclick='test()' class="test" >
    <option value="test">
    Test
    </option>
    <option>
    Test</option>   
    </div>

=
 </body>

 <script>
 function test()
 {
     x=document.getElementsByClassName('test')[1];
     console.log(x.value);
 }
 
 </script>

</html>