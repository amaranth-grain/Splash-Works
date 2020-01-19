
                $(document).ready(function(){
                    $(".doge").hide();
                    var count = 1;      

                    function rotation(el){
                      $(el).rotate({
                        angle:0,
                        animateTo:360,
                      });
                    }

                    /*rotation("#dogePic2");*/

                    $("#testLink").click(function(){

                        if (count % 2 == 0) {
                            $("#doge1").fadeIn(1200).animate({left: "-200px"}, 4500, "swing").fadeOut(); 
                            $("#doge2").fadeIn(800).animate({right: "-600px"}, 6500, "swing").fadeOut();
                            $("#doge3").fadeIn(600).animate({left: '-800px'}, 5000, "swing").fadeOut();
                            $("#doge4").fadeIn(400).animate({left: '-1000px'}, 4800, "swing").fadeOut();
                            $("#dogePic").delay(3500).fadeIn(400).animate({left: '80px', height: '306px', width: 'auto'}).fadeOut(800);
                            count++;
                        } else {
                            $("#doge1").fadeIn(800).animate({left: '1000px'}, 4500, "swing").fadeOut();
                            $("#doge2").fadeIn(400).animate({right: '2000px'}, 6000, "swing").fadeOut();
                            $("#doge3").fadeIn(1200).animate({left: '800px'}, 5000, "swing").fadeOut();
                            $("#doge4").fadeIn(400).animate({left: '500px'}, 3800, "swing").fadeOut();

                            /*$("#dogePic").delay(3500).fadeIn(400).animate({left: '80px', height: '600px', width: 'auto'});*/
                            $("#dogePic").delay(3000).show();
                            rotation("#dogePic");
                            $("#dogePic").animate({left: '80px', height: '600px', width: 'auto'}).fadeOut(1000);
                            /*$("#dogePic").fadeOut(3000); */                                       

                            count++;
                        }

                    });
            });
            