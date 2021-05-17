for(y = 2018; y <= 2500; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // if year is 2015 selected
        if (y == 2018) {
            optn.selected = true;
        }
        
        document.getElementById('year').options.add(optn);
}

for(y = 2019; y <= 2500; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        
        // if year is 2015 selected
        if (y == 2018) {
            optn.selected = true;
        }
        
        document.getElementById('year2').options.add(optn);
}


