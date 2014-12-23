var params = new Array;
controllers.resultsListingController = function($scope,resultsListingFactory, $routeParams, $timeout){
	$scope.itemsPerPage = 20
	$scope.maxSize = 5;
	var params = {}
	//params['category'] = $routeParams.parent_id
	var page = $routeParams.params.split('--page_') 
	var uri = page[0].split('++filter_')
	var param = uri[0].split('-in-')
	var cat = param[0].split('-on-')
	var loc = param[1].split('-at-')
	
	params['category'] = cat[0]
	params['subcategory'] = cat[1]
	params['location'] = loc[0]
	params['suburb'] = loc[1]
	if(typeof uri[1] != 'undefined')
	params['searchby'] = uri[1].split('-+price_')[0]
	params['sortby'] = ''
	params['filterby'] = ''
	if(typeof uri[1] != 'undefined'){
		params['pricerangegreaterthan'] = uri[1].split('-+price_')[1].split('&')[0].split('=')[1]
		params['pricerangelessthan'] = uri[1].split('-+price_')[1].split('&')[1].split('=')[1]
	}
	params['currentPage'] = page[1]
	if(typeof page[1] != 'undefined'){
		params['limitS'] = ((page[1]-1)*$scope.itemsPerPage)
	}else{
		params['limitS'] = 0
	}
	params['limitE'] = $scope.itemsPerPage
	
	resultsListingFactory.getResultList(params, $scope);
	
	$scope.loc = function(){
		if(params['location'] == 'qatar'){
			return true
		}else{
			return false
		}
	}
	
	$scope.resultLists = function(data){
		$scope.resultList = data
		$scope.totalItems = data.count;
		$scope.currentPage = page[1];
		
  		//$scope.bigTotalItems = 175;
  		//$scope.bigCurrentPage = 1;
		if(uri[1].split('-+price_')[1].split('&')[0].split('=')[1] != '')
		$scope.price_less = parseInt(uri[1].split('-+price_')[1].split('&')[0].split('=')[1])
		else
		$scope.price_less = ''
		if(uri[1].split('-+price_')[1].split('&')[1].split('=')[1] != '')
		$scope.price_maxim = parseInt(uri[1].split('-+price_')[1].split('&')[1].split('=')[1])
		else
		$scope.price_maxim = ''
		
		$scope.catList = resultsListingFactory.getSubCategories({'category_sub_parentId':data.category[0].category_id})
		
		$scope.locationList = resultsListingFactory.getLocations()
		if(typeof uri[1] != 'undefined')
		$scope.searchproduct.title = uri[1].split('&')[0].split('=')[1]
		$scope.searchproduct.category = cat[1]
		$scope.searchproduct.location = loc[0]
		var brandArr = new Array
		if(typeof params['searchby'] != 'undefined'){
			var filterarr = params['searchby'].split('&')
			for(i=0; filterarr.length > i; i++){
				var tmpar = filterarr[i].split('=')
				if(tmpar[0]=='brand'){
					brandArr.push(tmpar[1])
				}
			}
			$scope.filter = {
				brands: brandArr
			};
			//console.log()
		}
	}
	
	$scope.validateMSG = function(data){
		$scope.error = data
	}
	$scope.pageChanged = function(){
		params['currentPage'] = $scope.currentPage
		$scope.getURL()
	}
	
	$scope.setParams = function(key,value){
		//alert(key)
		switch(key) {
			case 'category':
				params['category'] = value
				break;
			case 'subcategory':
				params['subcategory'] = value
				break;
			case 'location':
				params['location'] = value
				break;
			case 'suburb':
				params['suburb'] = value
				break;
			case 'searchby':
				params['searchby'] = value
				break;
			case 'sortby':
				params['sortby'] = value
				break;
			case 'pricerangegreaterthan':
				params['pricerangegreaterthan'] = value
				break;
			case 'pricerangelessthan':
				params['pricerangelessthan'] = value
				break;
			default:
				params['category'] = $routeParams.parent_id
		}
		//console.log(params['suburb'])
		$scope.getURL()
	}
	$scope.setPriceParams = function(a,b){
		if(typeof a != 'undefined' && a != null)
		params['pricerangegreaterthan'] = a
		else
		params['pricerangegreaterthan'] = ''
		
		if(typeof b != 'undefined' && b != null)
		params['pricerangelessthan'] = b
		else
		params['pricerangelessthan'] = ''
		$scope.getURL()
	}
	
	$scope.isList = true
	
	$scope.changeView = function(param){
		if(param=='grid'){
			$scope.isList = true
		}else{
			$scope.isList = false
		}
	}
	
	$scope.searchProduct = function(){
		var tmp = $scope.searchproduct
		if(typeof tmp.category != 'undefined')
		params['subcategory'] = tmp.category
		
		if(typeof tmp.location != 'undefined')
		params['location'] = tmp.location
		
		if(typeof tmp.title != 'undefined')
		params['searchby'] = 'title='+tmp.title

		$scope.getURL()
	}
	
	$scope.getURL = function(){
		var str = '/show-list/'
		if(params['category']!='undefined')
		str += params['category']
		
		if(typeof params['subcategory'] != 'undefined')
		str += '-on-'+params['subcategory']
		
		str += '-in-'
		if(typeof params['location'] != 'undefined')
		str += params['location']
		
		if(typeof params['suburb'] != 'undefined')
		str += '-at-'+params['suburb']
		
		if(typeof params['searchby'] != 'undefined')
		str += '++filter_'+params['searchby']
		
		if(typeof params['searchby'] != 'undefined' && typeof params['filterby'] != 'undefined')
		str += params['filterby']
		else
		str += '++filter_'+params['filterby']
		
		if(typeof params['pricerangegreaterthan'] != 'undefined')
		str += '-+price_min='+params['pricerangegreaterthan']
		
		if(typeof params['pricerangelessthan'] != 'undefined')
		str += '&max='+params['pricerangelessthan']
		
		if(typeof params['currentPage'] != 'undefined')
		str += '--page_'+params['currentPage']
		$scope.go(str)
	}
	
	
	
	$scope.position = {
		name: 'Potato Master',
		minAge: 25,
		maxAge: 40
	};
	  
	$scope.filter = {
		//brands: ["apple","asus","dell","greentel"]
	};
	
	$scope.filterBrands = function(){
		$timeout(function(){
			var filterUrl = ''
			var tmp = $scope.filter['brands']
			for(i = 0; tmp.length>i; i++){
				//console.log(tmp[i].trim())
				filterUrl += 'brand='+tmp[i].trim()
				if(i<tmp.length-1)
				filterUrl += '&'
			}
			if(typeof params['searchby'] == 'undefined'){
				params['searchby'] = filterUrl
			}else{
				var filterArr = params['searchby'].split('&')
				if(filterArr[0].indexOf('title')==-1){
					params['searchby'] = filterUrl
				}else{
					params['searchby'] = filterArr[0]+'&'+filterUrl	
				}
				//params['searchby'] += '&'+filterUrl
			}
			
			$scope.getURL()
		},200)
	}
	
	
	$scope.resetParams = function(param){
		switch(param){
			case('subcategory'):
				params['subcategory'] = undefined
			break;
			case('location'):
				params['location'] = 'qatar'
				params['suburb'] = undefined
			break;
			case('suburb'):
				params['suburb'] = undefined
			break;
		}
		$scope.getURL()
	}
}
