
<script>
// define dynamic field array that stores sub-category-ids 	
var  adTypeDfArr = new Array(
		1,2,3,4,5,6,7,8,9,10,11,12 // Subcategories of - Automobile 
		);

var iAmDfArr = new Array(
		1,2,3,4,5,6,7,8,9,10,11,12 // Subcategories of - Automobile
		);
						
var conditionDfArr = new Array(
		1,2,3 // Subcategories of - Automobile
		);
		
var priceDfArr = new Array(
		1,2,3 // Subcategories of - Automobile
		);

var specificTypeDfArr = new Array(
		1,4,7,10 // Subcategories of - Automobile
		);

var brandDfArr = new Array(
		1,2,4,5,7,8,10,11 // Subcategories of - Automobile
		);

var specificTypeNameArr = new Array();
// define array with index = subcategoryId and values with subcategory specific type values
specificTypeNameArr[1] 	= new Array('Bicycle', 'Bike', 'Scooter'); 
specificTypeNameArr[4] 	= new Array('Bicycle', 'Bike', 'Scooter', 'kid cycle'); 
specificTypeNameArr[7] 	= new Array('Bicycle', 'Bike', 'Scooter', 'Geared Cycle', 'Anytype scooter'); 
specificTypeNameArr[10] = new Array('Bicycle', 'Bike', 'Scooter', 'Foreign bikes'); 

var brandNameArr 	= new Array();
//define array with index = subcategoryId and values with subcategory brand values
brandNameArr[1] 	= new Array('Hero', 'Hero Honda', 'Bajaj', 'Yamaha');
brandNameArr[4] 	= new Array('Hero', 'Hero Honda', 'Bajaj', 'Yamaha');
brandNameArr[7] 	= new Array('Hero', 'Hero Honda', 'Bajaj', 'Yamaha');
brandNameArr[10] 	= new Array('Hero', 'Hero Honda', 'Bajaj', 'Yamaha');
brandNameArr[2] 	= new Array('Maruti', 'Honda', 'Skoda', 'Mercedes');  


</script>


<script type="text/javascript">
	$(document).ready(function(){

		// On category selection, populate sub-categories			
		$("#categoryId").change(function(){
			//alert("something is changed");
			var categoryId = $("#categoryId").val();
			
			//first remove all existing elements
			$("#subCategoryId").empty();

			//hide dynamic shown fields
			$("#dynamicFields").hide();
			
			//Now, make ajax call and populate list
			  $.ajax({
					url:"<?php echo $this->config->item('subCategoryBeAction').'/getList'; ?>", 
					type: "POST",
					data: "categoryId="+categoryId,
					dataType: "json",	
					success:function(resultData){
						//alert(resultData);
						$("#subCategoryId").append(new Option("--Subcategory--", "0"));
						for(var i=0; i<resultData.length ;i++){
							//alert(resultData[i].name);
							// $("#subCategoryId").append(new Option("text", "value"));	
							 $("#subCategoryId").append(new Option(resultData[i].name, resultData[i].id));																								
						}							
					}}
				);								
		});

		// On category selection, populate sub-categories			
		$("#subCategoryId").change(function(){
			
			var id = $("#subCategoryId").val();

			// check subcategory for dynamic fields and show/hide each dynamic field
			if (isFieldQualified(id, adTypeDfArr)){ $("#dynamicAdType").show(); } else { $("#dynamicAdType").hide(); } 
			if (isFieldQualified(id, iAmDfArr)){ $("#dynamicIAm").show(); } else { $("#dynamicIAm").hide(); } 
			if (isFieldQualified(id, conditionDfArr)){ $("#dynamicCondition").show(); } else { $("#dynamicCondition").hide(); } 
			if (isFieldQualified(id, priceDfArr)){ $("#dynamicPrice").show(); } else { $("#dynamicPrice").hide(); }

			//popupate Specific Type based on array populated
			var specificTypeFlag = generateSpecificTypeValues(id);			
			if (specificTypeFlag){ $("#dynamicSpecificType").show(); } else { $("#dynamicSpecificType").hide(); } 

			//popupate Brand based on array populated
			var brandFlag = generateBrandValues(id);			
			if (brandFlag){ $("#dynamicBrand").show(); } else { $("#dynamicBrand").hide(); } 			 
									
			// Display dynamic field block
			$("#dynamicFields").show();
			
				
		});		
				
	});//end of document.ready


function isFieldQualified(id, searchArr){
	for (i=0; i<searchArr.length; i++){
		//alert(adTypeArr[i]);
		if (searchArr[i]==id){return true;}
	}
	return false;
}

function generateSpecificTypeValues(id){
	// first, empty the list 
	$('#uiSpecificType').empty();	
	
	// itereate through every element
	for (i=0; i<specificTypeNameArr.length; i++){ //user condition as <= as index will start from > 0 as id will never be ZERO
		if(i == id && !(specificTypeNameArr[i] === undefined)){ //index matches with id of subcategory. That means this subcategory has specific type values
			// generate 'li' item for every value of the array
			for (j=0; j<specificTypeNameArr[i].length; j++){				
				$('#uiSpecificType').append ("<li class='' style=''> <input type='checkbox' name='specificType[]' value='"+specificTypeNameArr[i][j]+"'>"+specificTypeNameArr[i][j]+"</input> </li>");
			}			
			return true; // found				
		}
	}

	return false; //not found				
}


function generateBrandValues(id){
	// first, empty the list 
	$('#uiBrand').empty();	
	
	// itereate through every element
	for (i=0; i<brandNameArr.length; i++){ //user condition as <= as index will start from > 0 as id will never be ZERO
		if(i == id && !(brandNameArr[i] === undefined)){ //index matches with id of subcategory. 
			// generate 'li' item for every value of the array
			for (j=0; j<brandNameArr[i].length; j++){				
				$('#uiBrand').append ("<li class='' style=''> <input type='checkbox' name='brand[]' value='"+brandNameArr[i][j]+"'>"+brandNameArr[i][j]+"</input> </li>");
			}			
			return true; //found				
		}
	}

	return false; //not  found				
}

</script>
	
