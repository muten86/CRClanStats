sap.ui.jsview("view.Main", {

	/** Specifies the Controller belonging to this View. 
	* In the case that it is not implemented, or that "null" is returned, this View does not have a Controller.
	* @memberOf view.View1
	*/ 
	getControllerName : function() {
		return "view.Main";
	},
	


	/** Is initially called once after the Controller has been instantiated. It is the place where the UI is constructed. 
	* Since the Controller is given to this method, its event handlers can be attached right away. 
	* @memberOf view.View1
	*/ 
	createContent : function(oController) {
/*    
	    var oButton = new sap.m.Button(this.createId("helloButton"), {
	        text : "Click me",
	        press: [oController.onHelloWorld, oController]
	    });
	*/    
		
		function getColor(dons){ 
			//var tbl   = sap.ui.getCore();//.byId("idPlayerTab");
	       // var index = tbl.getSelectedIndex();
			var tb = dons.byId("idApp1");

			//var rowid = tb.getSelectedIndices();
			
			if(dons < 2000){

				return sap.ui.core.MessageType.Error;
			}else{

				return sap.ui.core.MessageType.Success;
			}
		};
		
		

		var page2 = 
			
			new sap.m.Page("page2", {
			title : "Hello Page 2",
			showNavButton : true,
			showHeader:false,
			navButtonPress : function () {
				// go back to the previous page
				app.back();
			}
			
		});

		var oBusy = new	sap.m.BusyDialog("busy");
		var oModel = new sap.ui.model.json.JSONModel();
		
		oModel.attachRequestCompleted(function() { 
			
			
			oBusy.close();	} );
		oModel.loadData("GetPlayer.php");
		
					function download(filename, content) {
				  var element = document.createElement('a');
				  var text = "";
				  
				   jQuery.get('/GetCompleteWarData.php', function(data){ 
				       text = data; 
				       
				       	  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
				  element.setAttribute('download', filename);

				  element.style.display = 'none';
				  document.body.appendChild(element);

				  element.click();

				  document.body.removeChild(element);
				       
				   });
				  
			
				}
		
	
	var otabBar = new sap.m.IconTabBar({ id: "myTabBar", 
												expanded:"{device>/isNoPhone}",
												items: [ new sap.m.IconTabFilter( {
													 								key : "playerIcon",
									                 								icon : "sap-icon://account"
																					} ) ,

																					new sap.m.IconTabFilter( {
														 								key : "warIcon",
										                 								icon : "sap-icon://shield"
																						} )
														]									

												});

			otabBar.attachSelect( function ( oControlEvent ){

					var item = oControlEvent.getParameters();
if(item.selectedKey == "playerIcon"){

	download("playerdata.csv","player");
}else{

	download("wardata.csv","war");
}
			});
			otabBar.placeAt("page2");

oBusy.placeAt("page2");
oBusy.open();
		
var playertab = new sap.ui.table.Table("idPlayerTab", { visibleRowCountMode: sap.ui.table.VisibleRowCountMode.Auto ,
														rowSettingsTemplate: new sap.ui.table.RowSettings("MyRowSetting", { highlight: "{color}" })//$getColors( )}" }//sap.ui.core.MessageType.Success }	

});


playertab.setSelectionMode(sap.ui.table.SelectionMode.None);
//Spaltenkonfiguration
playertab.addColumn( new sap.ui.table.Column({ 	label: new sap.ui.commons.Label({ text:"Rank" }), 
											template: new sap.m.Text({  text: "{rank}"      }),
											width:"10mm"  })
);

playertab.addColumn( new sap.ui.table.Column( { label: new sap.ui.commons.Label({text: "Name"}),
template: new sap.m.Text({  text: "{name}"      }) 	 , width:"50mm"	  							    
})
  			 	);


playertab.addColumn( new sap.ui.table.Column({ label: new sap.m.Label({ text:"Tag" }), 
template: new sap.m.Text({  text: "{tag}"      }) ,
width:"30mm"
})
);

var oColDonations = new sap.ui.table.Column({ 	label: new sap.m.Label({ text:"Donations" }), 
    									template: new sap.m.Text({  text: "{donations}"      }),	
    									sortProperty: "donations",
    									filterProperty: "donations",
    									width:"30mm"
  });

playertab.addColumn(oColDonations);
addColumnSorterAndFilter(oColDonations, compareIntegers);

 var oColDonations2 = new sap.ui.table.Column({ 	label: new sap.m.Label({ text:"Don W-1" }), 
		template: new sap.m.Text({  text: "{donlastweek}"      }),	
		sortProperty: "donlastweek",
		filterProperty: "donlastweek",
		width:"30mm"
});

playertab.addColumn(oColDonations2);
addColumnSorterAndFilter(oColDonations2, compareIntegers);

var oColDonations3 = new sap.ui.table.Column({ 	label: new sap.m.Label({ text:"Don W-2" }), 
template: new sap.m.Text({  text: "{don2week}"      }),	
sortProperty: "don2week",
filterProperty: "don2week",
width:"30mm"
});

playertab.addColumn(oColDonations3);
addColumnSorterAndFilter(oColDonations3, compareIntegers);

var oColDonations4 = new sap.ui.table.Column({ 	label: new sap.m.Label({ text:"Don W-3" }), 
template: new sap.m.Text({  text: "{don3week}"      }),	
sortProperty: "don3week",
filterProperty: "don3week",
width:"30mm"
});

playertab.addColumn(oColDonations4);
addColumnSorterAndFilter(oColDonations4, compareIntegers);



var oColLastSeen = new sap.ui.table.Column({ 	label: new sap.m.Label({ text:"Days offline" }), 
template: new sap.m.Text({  text: "{lastseen}"      }),	
sortProperty: "lastseen",
filterProperty: "lastseen",
width:"30mm"
});

playertab.addColumn(oColLastSeen);
addColumnSorterAndFilter(oColLastSeen, compareIntegers);


var oColTrophies =  new sap.ui.table.Column({ label: new sap.m.Label({ text:"Trophies" }), 
template: new sap.m.Text({  text: "{trophies}"      }) ,
width:"30mm",

sortProperty: "trophies",
filterProperty: "trophies"
});
//blaaa
playertab.addColumn(oColTrophies);
addColumnSorterAndFilter(oColTrophies, compareIntegers);

playertab.addColumn( new sap.ui.table.Column({ 	label: 		new sap.m.Label({ text:"Role" }), 
												template: 	new sap.m.Text("idColRole",{ text: "{role}" }),
												width:		"30mm" 
											})
);


var oColExpLevel = new sap.ui.table.Column({ label: new sap.m.Label({ text:"Level" }), 
template: new sap.m.Text({  text: "{expLevel}"      }) ,
sortProperty: "expLevel",
filterProperty: "expLevel",
width:"20mm"
});

var oColExpLevel = new sap.ui.table.Column({ label: new sap.m.Label({ text:"in Clan since" }), 
template: new sap.m.Text({  text: "{since}"      }) ,
width:"45mm"
});

playertab.addColumn(oColExpLevel);
addColumnSorterAndFilter(oColExpLevel, compareIntegers);


playertab.addColumn( new sap.ui.table.Column({ label: new sap.m.Label({ text:"CW-1" }), 
template: new sap.m.Text({  text: "{CW1}"      }) ,
width:"30mm"
})
);
playertab.addColumn( new sap.ui.table.Column({ label: new sap.m.Label({ text:"CW-2" }), 
template: new sap.m.Text({  text: "{CW2}"      }) ,
width:"30mm"
})
);


playertab.addColumn( new sap.ui.table.Column({ label: new sap.m.Label({ text:"CW-3" }), 
template: new sap.m.Text({  text: "{CW3}"      }) ,
width:"30mm"
})
);



playertab.placeAt(page2);
playertab.setModel(oModel);
playertab.bindRows("/members");


return page2;

		
	}
});