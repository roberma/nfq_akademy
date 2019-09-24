# nfq_akademy
Gauta užduotis buvo interpretuota kaip eilių valdymo sistema ligoninėje.
Vartotojas prisijungęs prie administravimo puslapio (admin.php) įvedęs vardą, pavardę ir pasirinkęs reikalingą specialistą užsiregistruoja vizitui ir yra pridedamas į eilę. Display.php puslapyje matomi 10 seniausiai užsiregistravusių vartotojų.
Specialistas savo ruožtu prisijungia prie savo paskyros puslapyje login.php. Teisingai suvedus prisijungimo vardą ir slaptažodį jis nukreipiamas į specialist.php puslapį, kur gali matyti aptarnaujamo kliento duomenis ir paspaudus mygtuką iškviesti kitą klientą. Aptarnauto kliento duomenys iš duomenų bazės ištrinami. Neteisingai įvedus prisijungimo duomenis specialistas nukreipiamas į error.php puslapį, kur parodomas klaidos pranešimas.

projektą sudaro 10 failų:
dbconfig.php - mysql duomenų bazės konfigūracinis failas
dbstruct - failas kuriame aprašyta duomenų bazės struktūra
admin.php - pagrindinis puslapis skirtas įterpti naujiems klientams į eilę
register.php - failas, kuris atvaizduoja informacinę žinutę, ar pavyko įterpti naują klientą į eilę
display.php - puslapis skirtas atvaizduoti pirmutinių eilėje esančių klientų sąrašą
login.php - prisijungimo puslapis, skirtas prisijungti specialistams
specialistui sėkmingai prisijungus jis nukreipiamas į specialist.php puslapį
specialist.php - specialistui prisijungus, šiame puslapyje leidžiama aptarnauti vartotojus pagal specialisto specializacija. Aptarnavus klientą, jo įrašas ištrinamas iš duomenų bazės.
error.php - puslapis kuriame parodomi specialisto puslapio klaidų pranešimai.
logout.php - puslapyje prisijungęs specialistas atsijungia nuo savo paskyros.
styles.css - stilių failas skirtas puslapių dizaino elementų atvaizdavimui

duomenų bazę sudaro keturios lentelės:
specialisation - skirta galimų specialistų specializacijų sąrašui saugoti
specialist - skirta specialistų duomenims saugoti. Saugoma specialisto vardas, pavardė, specializacija, elektroninio pasto adresas ir slaptažodis (hash formoje)
client - skirta lankytojų duomenims saugoti. Saugoma tokia informacija, kaip vartotojo vardas, pavardė, aptarnaujančio specialisto specializacija, registravimosi data ir laikas.
visit - skirta apsilankymo duomenims saugoti (buvo projektuota ateities praplėtimui, kad būtų galima saugoti informaciją apie apsilankymo trukmę.)

prisijungti prie puslapio galima adresu:
nfq.epizy.com/


