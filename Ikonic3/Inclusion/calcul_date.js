function dernierJourDuMois(mois, annee)
	{
		switch(mois)
		{
			case 4:
			case 6:
			case 9:
			case 11:
				return 30;
				
			case 2:
				if (annee%400==0 || (annee%4  == 0 && annee%100 !=0))
					return 29;
				else return 28;
			default:
				return 31;
		}
	}

function calculDate(echeance, fdm, le)
{

	var date = new Date();

	var jour = date.getDate();
	var mois = date.getMois()+1;
	var annee = date.getFullYear();

	if (echeance==0 && fdm==0)
	{
		return "01/01/1900";
	}

	jour += echeance;
	while (jour >dernierJourDuMois(mois,annee)
	{
		jour -= dernierJourDuMois(mois,annee);
		if (mois ==12)
		{
			mois = 1;
			annee+=1;
		}
		else
		{
			mois++;
		}	
	}

	if(fdm !=0)
	{
		jour = dernierJourDuMois(mois,annee);

		if(le!=0)
		{
			if(mois==12)
			{
				mois =1;
				annee+=1;
				jour=le;
			}
			else
			{
				mois++;
				jour = le;
			}
			
		}		
	}
	return jour+"/"+mois+"/"+annee;
}