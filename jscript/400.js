var bodyHTML;

function dom400(){
  var ribbons = document.getElementsByTagName("H1")[0];
  var ribbonArr = ribbons.innerHTML.split("<br>");
  ribbons.innerHTML="";
  ribbons.appendChild(document.createElement("span"));
  for(x=0;x<ribbonArr.length;x++){
    var newspan1 = document.createElement("span");
    var newtext1 = document.createTextNode(ribbonArr[x]);
    var newspan2 = document.createElement("span");
    newspan1.appendChild(newtext1);
    ribbons.appendChild(newspan1);
    ribbons.appendChild(newspan2);
  }
  var social = document.createElement("span");
  social.appendChild(document.getElementById('social'));
  ribbons.appendChild(social);
  ribbons.appendChild(document.createElement("span"));
  var portrait = document.createElement("span");
  portrait.appendChild(document.getElementById('portrait'));
  ribbons.appendChild(portrait);

  var collections = document.getElementsByClassName('collection');
  for(x=0;x<collections.length;x++){
    var thisCollection = collections[x].childNodes;
    colLength = thisCollection.length;
    console.log(thisCollection);
    console.log(colLength);
    for(y=colLength-1;y>=0;y--){
      if(thisCollection[y].nodeType != Node.TEXT_NODE){
        var newspan1 = document.createElement("span");
        thisCollection[y].parentNode.insertBefore(newspan1, thisCollection[y].nextSibling);
      }
    }
    var newspan0 = document.createElement("span");
    collections[x].insertBefore(newspan0, thisCollection[0].nextSibling);
  }

}


function domReset(){
  document.getElementsByTagName("BODY")[0].innerHTML = bodyHTML;
}

function loaded(){
  bodyHTML = document.getElementsByTagName("BODY")[0].innerHTML;
  dom400();
}

document.onload = loaded();
