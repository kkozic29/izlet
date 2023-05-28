#odabir svih korisnika
SELECT * FROM korisnik;

#odabir svih agencija
SELECT * FROM agencija;

#odabir svih moderatora
SELECT * FROM korisnik WHERE tip_id = 1;

#broj rezervacija moderatora agencije 1 za izlet 1
SELECT broj_mjesta FROM rezervacija
WHERE rezervacija.agencija_id = 1 AND rezervacija.izlet_id = 1;

#odabir svih organiziranih izleta agencije 1
SELECT * FROM agencija, rezervacija, izlet
WHERE agencija.agencija_id = rezervacija.agencija_id
AND rezervacija.izlet_id = izlet.izlet_id AND agencija.agencija_id = 1
AND izlet.organiziran = 1;

#broj potvrđenih predbiljezbi (sudionika) na izletu 1 agencije 1
SELECT COUNT(*) AS broj_sudionika FROM predbiljezba, rezervacija
WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id
AND predbiljezba.status = 1 AND rezervacija.izlet_id = 1 AND agencija_id = 1;

#popis sudionika izleta 1
SELECT ime, prezime, status FROM korisnik, predbiljezba, rezervacija
WHERE korisnik.korisnik_id = predbiljezba.korisnik_id
AND predbiljezba.rezervacija_id = rezervacija.rezervacija_id
AND rezervacija.izlet_id = 1;

#broj predbiljezbi agencije 1 izleta 1
SELECT COUNT(*) AS broj_predbiljezbi FROM predbiljezba, rezervacija
WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id
AND predbiljezba.status = 0 AND rezervacija.izlet_id = 1 AND rezervacija.agencija_id = 1;

#prikaz popunjenosti izleta agencija
SELECT izlet_id, ukupan_broj_mjesta, ((SELECT SUM(broj_mjesta) FROM rezervacija
WHERE rezervacija.izlet_id = izlet.izlet_id)) AS ukupan_broj_rezervacija FROM izlet

#prikaz postotka popunjenosti svih izleta
SELECT izlet_id, ukupan_broj_mjesta, ((SELECT COUNT(*) FROM predbiljezba, rezervacija
WHERE predbiljezba.rezervacija_id = rezervacija.rezervacija_id AND rezervacija.izlet_id = izlet.izlet_id)/ukupan_broj_mjesta)*100 AS popunjeno FROM izlet

#odabir svih izleta korisnika 3 uz filtiranje na temelju datuma i vremena polaska za razdoblje, npr. 01.01.2018. do 31.12.2018.
SELECT odrediste, datum_vrijeme_polaska, status, organiziran FROM izlet, rezervacija, predbiljezba
WHERE rezervacija.izlet_id = izlet.izlet_id
AND predbiljezba.rezervacija_id = rezervacija.rezervacija_id
AND predbiljezba.korisnik_id = 3
AND izlet.datum_vrijeme_polaska BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 00:00:00';
