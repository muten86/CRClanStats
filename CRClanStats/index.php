
			
			
			<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<title>Swiss Raiders Statistik</title>
	<script src="https://openui5.hana.ondemand.com/resources/sap-ui-core.js"
		id="sap-ui-bootstrap"
		data-sap-ui-theme="sap_belize"
		data-sap-ui-libs="sap.m, sap.ui.commons, sap.ui.table">
	</script>
	<script type="text/javascript">


		function addColumnSorterAndFilter(oColumn, comparator) {
		  var oTable = oColumn.getParent();
		  var oCustomMenu = new sap.ui.commons.Menu();
		   
		    oCustomMenu.addItem(new sap.ui.commons.MenuItem({
		                text: 'aufsteigend sortieren',
		                icon:"/com.sap.scn.demo/resources/sap/ui/table/themes/sap_goldreflection/img/ico12_sort_asc.gif",
		                select:function() {
		                 var oSorter = new sap.ui.model.Sorter(oColumn.getSortProperty(), false);
		                 oSorter.fnCompare=comparator;
		                 oTable.getBinding("rows").sort(oSorter);
		                
		                 for (var i=0;i<oTable.getColumns().length; i++) oTable.getColumns()[i].setSorted(false);                
		                 oColumn.setSorted(true);
		                 oColumn.setSortOrder(sap.ui.table.SortOrder.Ascending);
		                }
		    }));
		    oCustomMenu.addItem(new sap.ui.commons.MenuItem({
		     text: 'absteigend sortieren',
		        icon:"/com.sap.scn.demo/resources/sap/ui/table/themes/sap_goldreflection/img/ico12_sort_desc.gif",
		        select:function(oControlEvent) {
		             var oSorter = new sap.ui.model.Sorter(oColumn.getSortProperty(), true);
		             oSorter.fnCompare=comparator;
		             oTable.getBinding("rows").sort(oSorter);
		                
		             for (var i=0;i<oTable.getColumns().length; i++) oTable.getColumns()[i].setSorted(false);
		            
		             oColumn.setSorted(true);
		             oColumn.setSortOrder(sap.ui.table.SortOrder.Descending);
		        }
		    }));
		   
		    oCustomMenu.addItem(new sap.ui.commons.MenuTextFieldItem({
		  icon: '/com.sap.scn.demo/resources/sap/ui/table/themes/sap_goldreflection/img/ico12_filter.gif',
		  select: function(oControlEvent) {
		      var filterValue = oControlEvent.getParameters().item.getValue();
		      var filterProperty = oControlEvent.getSource().getParent().getParent().mProperties.sortProperty;
		      var filters = [];
		      if (filterValue.trim() != '') {
		      var oFilter1 = new sap.ui.model.Filter(filterProperty, sap.ui.model.FilterOperator.EQ, filterValue);
		      filters = [oFilter1];   
		      }
		      oTable.getBinding("rows").filter(filters, sap.ui.model.FilterType.Application);
		  }
		    }));
		   
		    oColumn.setMenu(oCustomMenu);
		    return oColumn;
		}


		/**
		 * Integer comparator
		 */
		function compareIntegers(value1, value2) {
		  if ((value1 == null || value1 == undefined || value1 == '') &&
		  (value2 == null || value2 == undefined || value2 == '')) return 0;
		  if ((value1 == null || value1 == undefined || value1 == '')) return -1;
		  if ((value2 == null || value2 == undefined || value2 == '')) return 1;
		  if(parseInt(value1) < parseInt(value2)) return -1;
		  if(parseInt(value1) == parseInt(value2)) return 0;
		  if(parseInt(value1) > parseInt(value2)) return 1;           
		};




	 

	    sap.ui.localResources("view");
	  
		var app = new sap.m.App({initialPage:"idApp1"});  
		var view = sap.ui.view({id:"idApp1", type:sap.ui.core.mvc.ViewType.JS, viewName:"view.Main"});
		
app.addPage(view);  
app.placeAt("content");  


			
	</script>
</head>
<body class="sapUiBody" id="content">
</body>
</html>