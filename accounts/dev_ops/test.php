<html dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta
      name="viewport"
      content="initial-scale=1, maximum-scale=1,user-scalable=no"
    />
    <title>
      Multiple popup elements | Sample | ArcGIS API for JavaScript 4.24
    </title>

    <link
      rel="stylesheet"
      href="https://js.arcgis.com/4.24/esri/themes/light/main.css"
    />
    <script src="https://js.arcgis.com/4.24/"></script>

    <style>
      html,
      body {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
      }

      .esri-popup--is-docked-top-right .esri-popup__main-container {
        max-height: 100%;
      }

      #appContainer {
        background-color: #fff;
        position: relative;
        flex-direction: column;
        height: 100%;
        width: 100%;
      }

      #mapDiv {
        position: fixed;
        width: 50%;
        height:100%;
      }

      .left-container {
        float: right;
        width: 50%;
        height:100%;
      }

      .text-center{
        text-align: center;
      }

      .form-header{
        font-size: 20px;
        text-transform: capitalize;
      }

      .form-group{
        margin: 1.5rem;
      }

      .form-group label {
            font-size: 1rem;
            line-height: 1.4rem;
            vertical-align: top;
            margin-bottom: .5rem;
        }

      .form-control{
        display: block;
        width: 100%;
        padding: 1rem 1rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1;
        color: #212529;
        background-color: color(white);
        background-clip: padding-box;
        border: 1px solid #ced4da;
        appearance: none;
        border-radius: 2px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }
    </style>

    <script>
      require(["esri/Map", "esri/views/MapView", "esri/layers/FeatureLayer"], (
        Map,
        MapView,
        FeatureLayer
      ) => {
        // setup the map
        const map = new Map({
          basemap: "dark-gray-vector"
        });

        const view = new MapView({
          container: "mapDiv",
          map: map,
          center: [125.33, 6.8500],
          zoom: 11,
          // Since there are many elements, it is best to dock the popup so
          // the elements display better rather than have to scroll through them all.
          popup: {
            dockEnabled: true,
            dockOptions: {
              buttonEnabled: false,
              breakpoint: false
            }
          }
        });

        const featureLayer = new FeatureLayer({
          url: "https://services7.arcgis.com/KpSishw2wZ2cdcqw/arcgis/rest/services/digos/FeatureServer/0",
          popupTemplate: {
            // autocasts as new PopupTemplate()
            title: "{Brgy_Name}",

            // Set content elements in the order to display.
            // The first element displayed here is the fieldInfos.
            content: [
              {
                // It is also possible to set the fieldInfos outside of the content
                // directly in the popupTemplate. If no fieldInfos is specifically set
                // in the content, it defaults to whatever may be set within the popupTemplate.
                type: "fields", // FieldsContentElement
                fieldInfos: [
                  {
                    fieldName: "Num_Preg",
                    visible: true,
                    label: "Number of Pregnants"
                  },
                  {
                    fieldName: "ZeroToFive",
                    visible: true,
                    label: "Children from 0-5 years old"
                  }
                ]
              }
            ]
          },
          outFields: ["*"]
        });

        map.add(featureLayer);

        // Get the screen point from the view's click event
        view.on("click", (event)=> {
            view.hitTest(event.screenPoint)
                .then(function (response) {
                    if (response.results.length > 0) {

                        var graphic = response.results.filter(function(result) { // check if the graphic belongs to the layer of interest
                            return result.graphic.layer === featureLayer;
                        })[0].graphic; 
                        
                        // do something with the result graphic
                        console.log(graphic.attributes.Brgy_Name);
                        console.log(graphic.attributes.Num_Preg);
                        console.log(graphic.attributes.ZeroToFive);

                        document.getElementById("barangayName").value = graphic.attributes.Brgy_Name;
                        document.getElementById("numPreg").value = graphic.attributes.Num_Preg;
                        document.getElementById("zeroToFive").value = graphic.attributes.ZeroToFive;
                    }
                });
        });

        function applyEditsToIncidents(params) {
          featureLayer
            .applyEdits(params)
            .then((editsResult) => {
              // Get the objectId of the newly added feature.
              // Call selectFeature function to highlight the new feature.
              if (editsResult.addFeatureResults.length > 0 || editsResult.updateFeatureResults.length > 0) {
                let objectId;
                if (editsResult.addFeatureResults.length > 0) {
                  objectId = editsResult.addFeatureResults[0].objectId;
                } else {
                  featureForm.feature = null;
                  objectId = editsResult.updateFeatureResults[0].objectId;
                }
              }
            })
            .catch((error) => {
              console.log("error = ", error);
            });
        }
        

      });
    </script>
  </head>

  <body>
    <div id="appContainer">
      <div id="mapDiv"></div>
      <div id="tableContainer" class="left-container">
        <p class="form-header text-center">sample text here</p>
        <form action="">
            <div class="form-group">
                <label for="">Barangay</label>
                <input type="text" id="barangayName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Number of Pregnants</label>
                <input type="number" id="numPreg" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Children 0-5 years old</label>
                <input type="number" id="zeroToFive" class="form-control" required>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>
