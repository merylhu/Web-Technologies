$(document).ready(function(){


			$('#search-form').validate({
	    rules: {
	       streetAddress: 
            {
	        required: true,
	       required: true
            },  
		 city: 
            {
	        required: true
	      },
		  state:
            {
				required: true,
			},	
		  
	    },
			 highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
		
        errorElement: 'span',
        errorClass: 'help-block error',
                  submitHandler: function() 
                {
                     $.getJSON('http://cs-server.usc.edu:56845/phpfile.php', 
                        $('form#search-form').serialize() , 
                        function(data){
                         $fb1=data.homedetails;
                         $fb2=data.year1;
                         $fb3="Last Sold Price:"+data.lastSoldPrice+", 30 Days Overall Change:"+data.estimateValueChange;
                         $fb3=encodeURIComponent($fb3);
                         $fb4=data.street+", "+data.city+", "+data.state+", "+data.zipcode;
                         $fb5=encodeURIComponent($fb4);
                         //onclick=shareit(\""+$fb1+"\",\""+$fb2+"\",\""+$fb3+"\",\""+$fb4+"\")
                         $initial="";
                         
                     
                         //$initial+="<center>";
                          //$initial+="<div class=\"tabbable\" style=\"margin-bottom:18px;margin-left:40px margin-right:40px width:75%\">";
                         // $initial+="<ul class=\"nav nav-tabs\" role=\"tablist\">";
                          //$initial+="<li role=\"presentation\" class=\"active\">";
                         // $initial+="<a href=\"#tab1\" data-toggle=\"tab\" role=\"tab\">Basic Info</a></li>";
                        //  $initial+="<li role=\"presentation\">";
                        //  $initial+="<a href=\"#tab2\" data-toggle=\"tab\" role=\"tab\">Historical Zestimates</a></li>";
                         //$initial+= "</ul>";  
                          //$initial+="<div class=\"tab-content\" style=\"padding-bottom: 9px; border-bottom: 1px solid #ddd;\"><div role=\"tabpanel\" class=\"tab-pane fade in active\" id=\"tab1\"></div><div role=\"tabpanel\" class=\"tab-pane fade\" id=\"tab2\"></div></div>";
                       //  $('div#message').html($initial);
                         
                         $ch="";
                         $ch+="<div id=\"carousel-example-generic\" class=\"carousel slide\" style=\"background:white;\" data-ride=\"carousel\"><ol class=\"carousel-indicators\" id=\"olMoveIt\"><li data-target=\"#carousel-example-generic\" data-slide-to=\"0\" class=\"active\"></li><li data-target=\"#carousel-example-generic\" data-slide-to=\"1\"></li><li data-target=\"#carousel-example-generic\" data-slide-to=\"2\"></li></ol><div class=\"carousel-inner\" align=\"center\" role=\"listbox\"><div class=\"item active\">";
                         $ch+="<img src="+data.year1+" alt=\"1year\"><div align=\"left\" style=\"height:25%\" id=\"chartfooter\"><div>&nbsp;&nbsp;Historical Zestimate for 1Year<br/><p style=\"font-size:15px\">&nbsp;&nbsp;"+$fb4+"</p><br/></div></div></div>";
                         $ch+="<div class=\"item\" style=\"background:white\"><img src="+data.years5+" alt=\"5years\"><div align=\"left\" style=\"height:25%\" id=\"chartfooter\"><div>&nbsp;&nbsp;Historical Zestimate for 5Years<br/><p style=\"font-size:15px\">&nbsp;&nbsp;"+$fb4+"</p><br/></div></div></div>";
                         $ch+="<div class=\"item\" style=\"background:white\"><img src="+data.years10+" alt=\"10years\"><div align=\"left\" style=\"height:25%\" id=\"chartfooter\"><div>&nbsp;&nbsp;Historical Zestimate for 10Years<br/><p style=\"font-size:15px\">&nbsp;&nbsp;"+$fb4+"</p><br/></div></div></div></div>";
                         $ch+="<a class=\"left carousel-control\" href=\"#carousel-example-generic\" role=\"button\" data-slide=\"prev\"><span id=\"glyphColor\" class=\"glyphicon glyphicon-chevron-left\"></span><span class=\"sr-only\">Previous</span></a><a class=\"right carousel-control\" href=\"#carousel-example-generic\" role=\"button\" data-slide=\"next\"><span id=\"glyphColor\" class=\"glyphicon glyphicon-chevron-right\"></span><span class=\"sr-only\">Next</span></a></div>";
                         alert($ch);
                         
                         $val=" <table class=\"table table-striped success\" style=\"width:80%; background:white\"><tr><td id=\"l\">See more details for <a target=\'_blank\' style =\"text-decoration:none;font-weight:bold;\" href=\""+data.homedetails+"\">"+data.street+", "+data.city+", "+data.state+" "+data.zipcode+"</a> on Zillow</td><td></td><td></td><td><button type=\"button\" class=\"btn btn-primary\" id=\"fb\" onclick=shareit(\""+$fb1+"\",\""+$fb2+"\",\""+$fb3+"\",\""+$fb5+"\") >Share on <b>facebook</b></button></td></tr><tr><td id=\"l\">Property Type:</td><td id =\"l\">"+data.useCode+"</td><td id=\"l\">Last Sold Price:</td><td style=\"text-align:right;\">&#36;"+data.lastSoldPrice+"</td></tr><tr><td id=\"l\">Year Built:</td><td id =\"l\">"+data.yearBuilt+"</td><td id=\"l\">Last Sold Date:</td><td style=\"text-align:right;\">"+data.lastSoldDate+"</td></tr><tr><td id=\"l\">Lot Size:</td><td id=\"l\">"+data.lotSizeSqFt+" sq. ft.</td><td id=\"l\">Zestimate <sup>&reg;</sup> Property Estimate as of "+data.estimateLastUpdate+":</td><td style=\"text-align:right;\">&#36;"+data.estimateAmount+"</td></tr><tr><td id=\"l\">Finished Area:</td><td id=\"l\">"+data.finishedSqFt+" sq. ft.</td><td id=\"l\">30 Days Overall Change "+data.imgn+" </td>";
                         
                         
                         $val+="<td style=\"text-align:right;\">&#36;"+data.estimateValueChange+"</td></tr><tr><td id=\"l\">Bathrooms:</td><td id=\"l\">"+data.bathrooms+"</td><td id=\"l\">All Time Property Range:</td><td style=\"text-align:right;\">&#36;"+data.estimateValuationRangeLow+" - &#36;"+data.estimateValuationRangeLow+"</td></tr><tr><td id=\"l\">Bedrooms:</td><td id=\"l\">"+data.bedrooms+"</td><td id=\"l\">Rent Zestimate <sup>&reg;</sup> Valuation as of "+data.restimateLastUpdate+":</td><td style=\"text-align:right;\">&#36;"+data.restimateAmount+"</td></tr><tr><td id=\"l\">Tax Assessment Year:</td><td id=\"l\">"+data.taxAssessmentYear+"</td><td id=\"l\">30 Days Rent Change:"+data.restimateLastUpdate+"</td><td style=\"text-align:right;\">&#36;"+data.restimateValueChange+"</td></tr><tr><td id=\"l\">Tax Assessment:</td><td id= \"l\">&#36;"+data.taxAssessment+"</td><td id=\"l\">All Time Rent Range:</td><td style=\"text-align:right;\">&#36;"+data.restimateValuationRangeLow+" - &#36;"+data.restimateValuationRangeHigh+"</td></tr></table>";
                         
                         
                          
                        
                         $charts='';
                         
              $charts += '<div id="carousel-1" class="carousel slide" data-ride="carousel">';
								$charts += '<ol class="carousel-indicators">';
								$charts += '<li data-target="#carousel-1" data-slide-to="0" class="active"></li>';
								$charts += '<li data-target="#carousel-1" data-slide-to="1"></li>';
								$charts += '<li data-target="#carousel-1" data-slide-to="2"></li>';
								$charts += '</ol>';
								
								$charts += '<div class="carousel-inner" role="listbox">';
								$charts += '<div class="item active">';
								$charts += '<img src="' + data.year1 + '" class="img-responsive center-block" alt="Historical Zestimate for the past 1 year">';
								$charts += '<div class="carousel-caption">';
								$charts += '<h3>Historical Zestimate for the past 1 year</h3><p>' + $fb4 + '</p>';
								$charts += '</div></div>';
								$charts += '<div class="item">';
								$charts += '<img src="' + data.years5+ '" class="img-responsive center-block" alt="Historical Zestimate for the past 5 years">';
								$charts += '<div class="carousel-caption">';
								$charts += '<h3>Historical Zestimate for the past 5 years</h3><p>' + $fb4 + '</p>';
								$charts += '</div></div>';
								$charts += '<div class="item">';
								$charts += '<img src="' + data.years10 + '" class="img-responsive center-block" alt="Historical Zestimate for the past 10 years">';
								$charts += '<div class="carousel-caption">';
								$charts += '<h3>Historical Zestimate for the past 10 years</h3><p>' + $fb4 + '</p>';
								$charts += '</div></div>';
								$charts += '</div>';
								
								$charts += '<a class="left carousel-control" href="#carousel-1" role="button" data-slide="prev">';
								$charts += '<span class="glyphicon glyphicon-chevron-left"></span>';
								$charts += '<span class="sr-only">Previous</span></a>';
								$charts += '<a class="right carousel-control" href="#carousel-1" role="button" data-slide="next">';
								$charts += '<span class="glyphicon glyphicon-chevron-right"></span>';
								$charts += '<span class="sr-only">Next</span></a>';
								$charts += '</div>';
                         	
                         
                            $prep = '';
							$prep += '<ul class="nav nav-tabs" role="tablist">';
							$prep += '<li role="presentation" class="active"><a href="#info" role="tab" data-toggle="tab">Basic Info</a></li>';
							$prep += '<li role="presentation"><a href="#charts" role="tab" data-toggle="tab">Historical Zestimates</a></li>';
							$prep += '</ul>';
							$prep += '<div class="tab-content">';
							$prep += '<div role="tabpanel" class="tab-pane fade in active" id="info">'+$val+'</div>';
							$prep += '<div role="tabpanel" class="tab-pane fade" id="charts">'+$charts+'</div>';
							$prep += '</div>';
                         alert($prep);
                        // document.getElementById('message').innerHTML=$prep;
							$('div#message').html($prep);
                        
                 
                         //&copy; Zillow, Inc., 2006-2014. Use is subject to <a href=\"http://www.zillow.com/corp/Terms.htm\">Terms of Use<a> <br></br> <a href=\"http://www.zillow.com/zestimate/\">What's a Zestimate?<a>
                                
							
                            
                           
                        });
                     
                    } 
                 

}); // end document.ready
});
                      