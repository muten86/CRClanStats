sap.ui.controller("view.Main", {
    

/**
* Called when a controller is instantiated and its View controls (if available) are already created.
* Can be used to modify the View before it is displayed, to bind event handlers and do other one-time initialization.
* @memberOf view.View1
*/
//	onInit: function() {
//
//	},

/**
* Similar to onAfterRendering, but this hook is invoked before the controller's View is re-rendered
* (NOT before the first rendering! onInit() is used for that one!).
* @memberOf view.View1
*/
//	onBeforeRendering: function() {
//
//	},

/**
* Called when the View has been rendered (so its HTML is part of the document). Post-rendering manipulations of the HTML could be done here.
* This hook is the same one that SAPUI5 controls get after being rendered.
* @memberOf view.View1
*/
//	onAfterRendering: function() {
//
//	},
	colorFormatter: function(value) {
		this.addStyleClass("green");
		/*
	     if (value == "") {
	          this.addStyleClass("yellow");
	          //this.getView().addStyleClass("yellow");
	}else{
	          this.addStyleClass("green");
	}
	return value;
	*/
	}

//onAfterRendering: function() {
//	var tabData2 = sap.ui.getCore().byId("idPlayerTab").getModel();
//	var name = tabData2.getProperty("/members/1/name")
//	tabData2.setProperty("/members/1/name", name.addStyleClass("green"));
	
			/*var oData = tabData2.getProperty("/members");
	if (oData instanceof Array) {

		oData[1].name.addStyleClass("green");
		var name = oData[1].name;*/
		/*
	  oData.foreach( function(oValue, i) {
		  oValue.addStyleClass("green");
	  });
	  
	}
*/
	/*
	var tabData = sap.ui.getCore().byId("idPlayerTab").getModel().getData().modelData;
	  var tabDataLength = tabData.length;
	  var colId = "";
	  var colValue = "";
	  for(var i =0; i<tabDataLength; i++){
	  colId = "idColRole-__clone" + i;
	  colValue = sap.ui.getCore().byId(colId).getText();
	  colValue = parseInt(colValue);
	  */
	  /*
	  if(colValue < 100){
	 sap.ui.getCore().byId(colId).addStyleClass("red");
	 sap.ui.getCore().byId(colId).removeStyleClass("green");
	 sap.ui.getCore().byId(colId).removeStyleClass("yellow");
	  }else if(colValue >= 100 && colValue < 200){
	 sap.ui.getCore().byId(colId).addStyleClass("yellow");
	 sap.ui.getCore().byId(colId).removeStyleClass("red");
	 sap.ui.getCore().byId(colId).removeStyleClass("green");
	  }else if(colValue >= 200){
	 sap.ui.getCore().byId(colId).addStyleClass("green");
	 sap.ui.getCore().byId(colId).removeStyleClass("yellow");
	 sap.ui.getCore().byId(colId).removeStyleClass("red");
	  }
	  }
*/

	 // sap.ui.getCore().byId(colId).addStyleClass("green");

/**
* Called when the Controller is destroyed. Use this one to free resources and finalize activities.
* @memberOf view.View1
*/
//	onExit: function() {
//
//	}

})