function CleanNumber(value) {
    // Assumes string input, removes all commas, dollar signs, and spaces      
    newValue = value.replace(",", "");
    newValue = newValue.replace("€", "");
    newValue = newValue.replace(/ /g, '');
    return newValue;

}

function round(value) {
    return parseFloat(Math.round(value * 100) / 100).toFixed(2);
}

function CommaFormatted(amount) {
    var i = parseFloat(amount);
    if (isNaN(i)) {
        return '';
    }
    i = Math.abs(i);
    var minus = '';
    if (i < 0) {
        minus = '-';
    }
    var n = new String(i);
    var a = [];
    if (n.length > 0) {
        a.unshift(n);
    }
    amount = minus + n + "€";
    return amount;
}

function calcProdSubTotal() {

    var prodSubTotal = 0;
    var reduc = 0;
    var poidsTotal = 0;
    var volumeTotal = 0;
	
    $(".row-total-input").each(function() {
        var valString = $(this).val() || 0;
        prodSubTotal += parseFloat(valString);
    });

    $(".row-totalp-input").each(function() {
        var valStringp = $(this).val() || 0;
        poidsTotal += parseFloat(valStringp);
    });

    $(".row-totalv-input").each(function() {
        var valStringv = $(this).val() || 0;
        volumeTotal += parseFloat(valStringv);
    });

    var nbtr = ($('#order-table tr').length) - 1;
    var prixred = 0;
    var rednbart = 0;

    for (var i = 1; i <= nbtr; i++) {
        rednbart = parseFloat($('#order-table tr:eq(' + i + ') td:eq(3) input.num-pallets-input').val()) + rednbart;

    }

    if (reduc != 0) {
        prixred = parseFloat(prodSubTotal) - reduc;
        $('.Total').empty();
        $('.Total').append('<span>MONTANT TTC SANS REDUCTION</span> ');
        $('.Total').append('<input type="text" name="totalTTC" class="total-box"  value="0&euro;" id="product-subtotal" readonly></input> ');
        $('.Totalreduc').empty();
        $('.Totalreduc').append('<span>MONTANT TTC &Agrave; PAYER</span> ');
        $('.Totalreduc').append('<input type="text" class="total-box" name="prixred" id="product-red" readonly></input> ');
        $('#product-red').val(prixred + "€");
    } else {
        $('.Totalreduc').empty();
    }

    /*$("#product-subtotal").val(prodSubTotal);
    if ($("#product-subtotal").val()=="0€")
    {
    	$('#product-red').val("0€");
    }*/

    $("#product-ht").val(round(prodSubTotal));
    $("#product-poids").val(poidsTotal);
    $("#product-volume").val(volumeTotal);
    calculTva();
}

function calculTva() {
    var valtva = 0;

    var bool = $('#product-red').val() || 0;
    if (!bool) {
        valtva = parseFloat($("#product-ht").val()) * 0.2;
    } else {
        valtva = parseFloat($('#product-red').val()) * 0.2;

    }
	
    $("#product-TVA").val(round(valtva));
    $("#product-subtotal").val(round(parseFloat($("#product-ht").val()) + valtva));
}




// DOM READY
$(document).ready(function() {
    var inc = 1;
    var nbphotos = 1;

    $(".btnP").attr("disabled", true);
    $(".btnM").attr("disabled", true);

    $(".row-total-input").val("0€");
    $(".num-pallets-input").val(0);
    $(".prix").val("0€");
    $(".total-box").val("0€");
    $('#order-table tbody tr:eq(1) td:eq(0) input.btn-sup').hide();

    $('#nom').change(function() {
        var date = new Date();
        var num = date.getMilliseconds() + date.getMonth() + date.getDay() + date.getDate() + date.getDate() + date.getMilliseconds() + 5000;
        num = "Commande N° FI000" + num;
        $('span#numfact').text(num);
        $('input#incommande').val(num);
    });

    $(".btn-sup").bind("click", function() {
        $el = $(this);
        $el.parent().parent().remove();
        calcProdSubTotal();
    });

    $('#default td:eq(1) input.name-pics').val("");

    $(".btn_newpics").bind("click", function() {
        //Création Nouvelle Ligne Tableau
        $('#order-table tbody tr:eq(1) td:eq(0) input').show();
        $('tr#default').clone(true).removeAttr('id').appendTo('tbody#tablco');

        $('#order-table tbody tr td input').show();
        $('#order-table tbody tr:eq(1) td:eq(0) input.btn-sup').hide();

        calcProdSubTotal();

    });

    $(".selected_format_input").change(function() {
        //var format = $(this).val();
        var valeur = $(this).val().split("|");
        var format = valeur[0];
        var libelle = valeur[1] + "\nSN : ";
        var poids = valeur[3];
        var volume = valeur[2];
        var ref = valeur[4];
        var stock = valeur[5];
        var remise = $(".remise").val();

        $el = $(this);
        $el.parent().parent().find("td.num-pallets input.num-pallets-input").val(0);
        $el.parent().parent().find("td.product-title textarea.name-pics").val(libelle);
        $el.parent().parent().find("td.Poids_article input.poids").val(poids);
        $el.parent().parent().find("td.Volume_article input.volume").val(volume);
        $el.parent().parent().find("td.remise_article input.remise_article-input").val(remise);

        document.getElementById("iarticle").innerHTML = ref;
        document.getElementById("ipoids").innerHTML = poids;        
        document.getElementById("ivolume").innerHTML = volume;
        document.getElementById("istock").innerHTML = stock;

        if (format != "0") {
            var prix = parseFloat(format);
        } else {
            var prix = 0;
        }

        if (format != "0") {
            $el.parent().parent().find("td.num-pallets input.btnM").attr("disabled", false);
            $el.parent().parent().find("td.num-pallets input.btnP").attr("disabled", false);
        } else {
            $el.parent().parent().find("td.num-pallets input.num-pallets-input").val("0");
            $el.parent().parent().find("td.num-pallets input.btnM").attr("disabled", true);
            $el.parent().parent().find("td.num-pallets input.btnP").attr("disabled", true);
        }

        nb = ($el.parent().parent().find("td.num-pallets input.num-pallets-input").val());

        $el.parent().parent().find("td.prix_article input").val(round(prix));

        if (prix != "") {
            prix = parseFloat(prix) * nb;
        }

        $el.parent().parent().find("td.row-total input.row-total-input").val(round(prix));

        calcProdSubTotal();
    });

    $(".num-pallets-input").bind("keyup", function() {
        $el = $(this);
        var prix = 0;
        var nb = 0;
        var poids = 0;
        var volume = 0;
        nb = ($el.parent().parent().find("td.num-pallets input.num-pallets-input").val());
        if ($el.parent().parent().find("td.prix_article input.prix").val() != "") {
            var prix = 0;
            prix = round((parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (parseFloat($el.parent().parent().find("td.remise_article input.remise_article-input").val()) / 100)));
            poids = (parseFloat($el.parent().parent().find("td.Poids_article input.poids").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
            volume = (parseFloat($el.parent().parent().find("td.Volume_article input.volume").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
        }
        $el.parent().parent().find("td.num-pallets input.num-pallets-input").val(nb);
        if ($el.parent().parent().find("td.prix_article input.prix").val() != "") {
            prix = round((parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (parseFloat($el.parent().parent().find("td.remise_article input.remise_article-input").val()) / 100)));
            poids = (parseFloat($el.parent().parent().find("td.Poids_article input.poids").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
            volume = (parseFloat($el.parent().parent().find("td.Volume_article input.volume").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
        }
        $el.parent().parent().find("td.row-total input.row-total-input").val(round(prix));
        $el.parent().parent().find("td.row-totalp input.row-totalp-input").val(poids);
        $el.parent().parent().find("td.row-totalv input.row-totalv-input").val(volume);
        calcProdSubTotal();
    });

    $(".num-pallets-input").bind("click", function() {
        $el = $(this);
        var prix = 0;
        var nb = 0;
        var poids = 0;
        var volume = 0;
        nb = ($el.parent().parent().find("td.num-pallets input.num-pallets-input").val());
        if ($el.parent().parent().find("td.prix_article span.prix").val() != "") {
            var prix = 0;
            prix = round((parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (parseFloat($el.parent().parent().find("td.remise_article input.remise_article-input").val()) / 100)));
            poids = (parseFloat($el.parent().parent().find("td.Poids_article input.poids").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
            volume = (parseFloat($el.parent().parent().find("td.Volume_article input.volume").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
        }
        $el.parent().parent().find("td.num-pallets input.num-pallets-input").val(nb);
        if ($el.parent().parent().find("td.prix_article input.prix").val() != "") {
            prix = round((parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (parseFloat($el.parent().parent().find("td.remise_article input.remise_article-input").val()) / 100)));
            poids = (parseFloat($el.parent().parent().find("td.Poids_article input.poids").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
            volume = (parseFloat($el.parent().parent().find("td.Volume_article input.volume").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val()));
        }
        $el.parent().parent().find("td.row-total input.row-total-input").val(round(prix));
        $el.parent().parent().find("td.row-totalp input.row-totalp-input").val(poids);
        $el.parent().parent().find("td.row-totalv input.row-totalv-input").val(volume);
        calcProdSubTotal();
    });

    $(".remise_article-input").bind("click", function() {
        $el = $(this);
        var remise = 0;
        var prix = 0;
        remise = ($el.parent().parent().find("td.remise_article input.remise_article-input").val());
        $el.parent().parent().find("td.remise_article input.remise_article-input").val(remise);
        if ($el.parent().parent().find("td.prix_article input.prix").val() != "") {

            prix = round((parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (remise / 100)));

        }
        $el.parent().parent().find("td.row-total input.row-total-input").val(round(prix));
        calcProdSubTotal();
    });

    $(".remise_article-input").bind("keyup", function() {
        $el = $(this);
        var remise = 0;
        var prix = 0;
        remise = ($el.parent().parent().find("td.remise_article input.remise_article-input").val());
        $el.parent().parent().find("td.remise_article input.remise_article-input").val(remise);
        if ($el.parent().parent().find("td.prix_article input.prix").val() != "") {

            prix = round((parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (remise / 100)));

        }
        $el.parent().parent().find("td.row-total input.row-total-input").val(round(prix));
        calcProdSubTotal();
    });

    $(".prix").bind("keyup", function() {
        $el = $(this);
        var prix = 0;
        $el.parent().parent().find("td.prix_article input.prix").val($el.parent().parent().find("td.prix_article input.prix").val());   
        prix = (parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (parseFloat($el.parent().parent().find("td.remise_article input.remise_article-input").val()) / 100));
        $el.parent().parent().find("td.row-total input.row-total-input").val(prix);
        calcProdSubTotal();
    });

    $(".prix").bind("click", function() {
        $el = $(this);
        var prix = 0;
        $el.parent().parent().find("td.prix_article input.prix").val($el.parent().parent().find("td.prix_article input.prix").val());   
        prix = (parseFloat($el.parent().parent().find("td.prix_article input.prix").val()) * parseFloat($el.parent().parent().find("td.num-pallets input.num-pallets-input").val())) * (1 - (parseFloat($el.parent().parent().find("td.remise_article input.remise_article-input").val()) / 100));
        $el.parent().parent().find("td.row-total input.row-total-input").val(prix);
        calcProdSubTotal();
    });

    $(".selected_facturation_input").change(function() {

        $el.parent().parent().find("input.adr1_f").val("");
        $el.parent().parent().find("input.adr2_f").val("");
        $el.parent().parent().find("input.adr3_f").val("");
        $el.parent().parent().find("input.cp_f").val("");
        $el.parent().parent().find("input.ville_f").val("");
        $el.parent().parent().find("input.pays_f").val("");
        $el.parent().parent().find("input.telbur_f").val("");
        $el.parent().parent().find("input.mail_f").val("");
        $el.parent().parent().find("input.web_f").val("");

        var valeur = $(this).val().split("|");

        $el.parent().parent().find("input.adr1_f").val(valeur[0]);
        $el.parent().parent().find("input.adr2_f").val(valeur[1]);
        $el.parent().parent().find("input.adr3_f").val(valeur[2]);
        $el.parent().parent().find("input.cp_f").val(valeur[3]);
        $el.parent().parent().find("input.ville_f").val(valeur[4]);
        $el.parent().parent().find("input.pays_f").val(valeur[5]);
        $el.parent().parent().find("input.telbur_f").val(valeur[6]);
        $el.parent().parent().find("input.mail_f").val(valeur[7]);
        $el.parent().parent().find("input.web_f").val(valeur[8]);

    });

    $(".selected_livraison_input").change(function() {

        $el.parent().parent().find("input.adr1_l").val("");
        $el.parent().parent().find("input.adr2_l").val("");
        $el.parent().parent().find("input.adr3_l").val("");
        $el.parent().parent().find("input.cp_l").val("");
        $el.parent().parent().find("input.ville_l").val("");
        $el.parent().parent().find("input.pays_l").val("");
        $el.parent().parent().find("input.telbur_l").val("");
        $el.parent().parent().find("input.mail_l").val("");
        $el.parent().parent().find("input.web_l").val("");

        var valeur = $(this).val().split("|");

        $el.parent().parent().find("input.adr1_l").val(valeur[0]);
        $el.parent().parent().find("input.adr2_l").val(valeur[1]);
        $el.parent().parent().find("input.adr3_l").val(valeur[2]);
        $el.parent().parent().find("input.cp_l").val(valeur[3]);
        $el.parent().parent().find("input.ville_l").val(valeur[4]);
        $el.parent().parent().find("input.pays_l").val(valeur[5]);
        $el.parent().parent().find("input.telbur_l").val(valeur[6]);
        $el.parent().parent().find("input.mail_l").val(valeur[7]);
        $el.parent().parent().find("input.web_l").val(valeur[8]);

    });

    function removeOptions(obj) {
        if (obj == null) return;
        if (obj.options == null) return;
        obj.options.length = 1; 
    }
	
	$(".btn_load_client").bind("click", function() {
        $el = $(this);
		var code_client = $el.parent().parent().find("input.cc").val();
        if(code_client !== ""){ //si la recherche est différent de rien
            $.ajax({
                type: "POST",
                url: "load_client.php",
                data: {
                        code_client : code_client
                },
                success: function (data){
						var datas = jQuery.parseJSON(data);
                        var nombreAdresseFacturation;
                        var nombreAdresseLivraison;
                        var valeurCleFacturation;
                        var valeurCleLivraison;
                        var i=0;
                        var j=0;
                        var bool=0;
						
						  $el.parent().parent().find("input.nom_commercial").val("");
                          $el.parent().parent().find("input.raison_social").val("");
                          $el.parent().parent().find("input.remise").val("");
                          $el.parent().parent().find("input.raison_social").val("");
						  $el.parent().parent().find("input.mode_reglement").val("");
						  $el.parent().parent().find("input.echeance").val("");
						  // Test echeance
						  $el.parent().parent().find("input.fdm").val("");
						  $el.parent().parent().find("input.jour").val("");
						  // Fin test
						  $el.parent().parent().find("textarea.infos").val("");
						   
						  $el.parent().parent().find("input.adr1_f").val("");
						  $el.parent().parent().find("input.adr2_f").val("");
						  $el.parent().parent().find("input.adr3_f").val("");
						  $el.parent().parent().find("input.cp_f").val("");
						  $el.parent().parent().find("input.ville_f").val("");
						  $el.parent().parent().find("input.pays_f").val("");
						  $el.parent().parent().find("input.telbur_f").val("");
						  $el.parent().parent().find("input.mail_f").val("");
						  $el.parent().parent().find("input.web_f").val("");
						  
						  $el.parent().parent().find("input.adr1_l").val("");
						  $el.parent().parent().find("input.adr2_l").val("");
						  $el.parent().parent().find("input.adr3_l").val("");
						  $el.parent().parent().find("input.cp_l").val("");
						  $el.parent().parent().find("input.v_l").val("");
						  $el.parent().parent().find("input.pays_l").val("");
						  $el.parent().parent().find("input.telbur_l").val("");
						  $el.parent().parent().find("input.mail_l").val("");
						  $el.parent().parent().find("input.web_l").val("");
 
                          removeOptions(document.getElementById('selectFacturation'));
                          removeOptions(document.getElementById('selectLivraison'));
						  
						$.each(datas, function (key, value) {
						 if(key==0)
						 {						   					   
						  $el.parent().parent().find("input.nom_commercial").val(value.nom_commercial);
                          $el.parent().parent().find("input.raison_social").val(value.raison_sociale);
                          $el.parent().parent().find("input.remise").val(value.remise);
						  $el.parent().parent().find("input.mode_reglement").val(value.mode_reglement);
						  $el.parent().parent().find("input.echeance").val(value.echeance);
						  // Test fin du mois jour
						  
						  if(value.fdm==1)
						  {
							  //$el.parent().parent().find("input.nom_commercial").val("coucou, test");
							  //$el.parent().parent().find("input.fdm").val("on");
							  document.getElementById("fdm").checked=true;
							  document.getElementById("findemois").value="oui";
						  }
						  else
						  {
							  document.getElementById("fdm").checked=false;
							  document.getElementById("findemois").value="non";
						  }
						
						  $el.parent().parent().find("input.jour").val(value.jour);
						  // Fin test
						  $el.parent().parent().find("textarea.infos").val(value.info_comp);
						 }
						 if(key==1)
						 {						  
						  $el.parent().parent().find("input.adr1_f").val(value.adr1);
						  $el.parent().parent().find("input.adr2_f").val(value.adr2);
						  $el.parent().parent().find("input.adr3_f").val(value.adr3);
						  $el.parent().parent().find("input.cp_f").val(value.cp);
						  $el.parent().parent().find("input.ville_f").val(value.ville);
						  $el.parent().parent().find("input.pays_f").val(value.pays);
						  $el.parent().parent().find("input.telbur_f").val(value.tel_bur);
						  $el.parent().parent().find("input.mail_f").val(value.email);					
						  $el.parent().parent().find("input.web_f").val(value.site_web);
						 }
						 if(key==2)
						 {						  
						  $el.parent().parent().find("input.adr1_l").val(value.adr1);					  
						  $el.parent().parent().find("input.adr2_l").val(value.adr2);					  
						  $el.parent().parent().find("input.adr3_l").val(value.adr3);					  
						  $el.parent().parent().find("input.cp_l").val(value.cp);					  
						  $el.parent().parent().find("input.v_l").val(value.ville);						  
						  $el.parent().parent().find("input.pays_l").val(value.pays);					  
						  $el.parent().parent().find("input.telbur_l").val(value.tel_bur);					  
						  $el.parent().parent().find("input.mail_l").val(value.email);				  
						  $el.parent().parent().find("input.web_l").val(value.site_web);
						 }
                         if(key==3){
                            nombreAdresseFacturation=value;
                            valeurCleFacturation=value;
                            i=4;
                         }
                         if(key==i && valeurCleFacturation>0){
                                var select = document.getElementById('selectFacturation');
                                var opt = document.createElement('option');
                                opt.value = value.adr1+"|"+value.adr2+"|"+value.adr3+"|"+value.cp+"|"+value.ville+"|"+value.pays+"|"+value.tel_bur+"|"+value.email+"|"+value.site_web;
                                opt.innerHTML = value.adr1+", "+value.adr2+", "+value.adr3+", "+value.cp+", "+value.ville+", "+value.pays+", "+value.tel_bur+", "+value.email+", "+value.site_web;
                                select.appendChild(opt);
                                i++;
                                valeurCleFacturation--;
                         }
                        if(key==3+nombreAdresseFacturation+1){
                            nombreAdresseLivraison=value;
                            i=4+nombreAdresseFacturation+1;
                         }
                         if(key==i && nombreAdresseLivraison>0){
                                var select = document.getElementById('selectLivraison');
                                var opt = document.createElement('option');
                                opt.value = value.adr1+"|"+value.adr2+"|"+value.adr3+"|"+value.cp+"|"+value.ville+"|"+value.pays+"|"+value.tel_bur+"|"+value.email+"|"+value.site_web;
                                opt.innerHTML = value.adr1+", "+value.adr2+", "+value.adr3+", "+value.cp+", "+value.ville+", "+value.pays+", "+value.tel_bur+", "+value.email+", "+value.site_web;
                                select.appendChild(opt);
                                i++;
                                nombreAdresseLivraison--;
                         }
                        });
                    }                        
            });
        }
    });
});