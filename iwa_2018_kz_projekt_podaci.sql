SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
USE `iwa_2018_kz_projekt` ;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`tip_id`, `naziv`) VALUES
(0, 'administrator'),
(1, 'voditelj'),
(2, 'korisnik');

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `tip_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`, `slika`) VALUES
(1, 0, 'admin', 'foi', 'Administrator', 'Admin', 'admin@foi.hr', 'korisnici/admin.jpg'),
(2, 1, 'voditelj', '123456', 'voditelj', 'Vodi', 'voditelj@foi.hr', 'korisnici/admin.jpg'),
(3, 2, 'pkos', '123456', 'Pero', 'Kos', 'pkos@fff.hr', 'korisnici/pkos.jpg'),
(4, 2, 'vzec', '123456', 'Vladimir', 'Zec', 'vzec@fff.hr', 'korisnici/vzec.jpg'),
(5, 2, 'qtarantino', '123456', 'Quentin', 'Tarantino', 'qtarantino@foi.hr', 'korisnici/qtarantino.jpg'),
(6, 2, 'mbellucci', '123456', 'Monica', 'Bellucci', 'mbellucci@foi.hr', 'korisnici/mbellucci.jpg'),
(7, 2, 'vmortensen', '123456', 'Viggo', 'Mortensen', 'vmortensen@foi.hr', 'korisnici/vmortensen.jpg'),
(8, 2, 'jgarner', '123456', 'Jennifer', 'Garner', 'jgarner@foi.hr', 'korisnici/jgarner.jpg'),
(9, 2, 'nportman', '123456', 'Natalie', 'Portman', 'nportman@foi.hr', 'korisnici/nportman.jpg'),
(10, 2, 'dradcliffe', '123456', 'Daniel', 'Radcliffe', 'dradcliffe@foi.hr', 'korisnici/dradcliffe.jpg'),
(11, 2, 'hberry', '123456', 'Halle', 'Berry', 'hberry@foi.hr', 'korisnici/hberry.jpg'),
(12, 2, 'vdiesel', '123456', 'Vin', 'Diesel', 'vdiesel@foi.hr', 'korisnici/vdiesel.jpg'),
(13, 2, 'ecuthbert', '123456', 'Elisha', 'Cuthbert', 'ecuthbert@foi.hr', 'korisnici/ecuthbert.jpg'),
(14, 2, 'janiston', '123456', 'Jennifer', 'Aniston', 'janiston@foi.hr', 'korisnici/janiston.jpg'),
(15, 2, 'ctheron', '123456', 'Charlize', 'Theron', 'ctheron@foi.hr', 'korisnici/ctheron.jpg'),
(16, 2, 'nkidman', '123456', 'Nicole', 'Kidman', 'nkidman@foi.hr', 'korisnici/nkidman.jpg'),
(17, 2, 'ewatson', '123456', 'Emma', 'Watson', 'ewatson@foi.hr', 'korisnici/ewatson.jpg'),
(18, 1, 'kdunst', '123456', 'Kirsten', 'Dunst', 'kdunst@foi.hr', 'korisnici/kdunst.jpg'),
(19, 2, 'sjohansson', '123456', 'Scarlett', 'Johansson', 'sjohansson@foi.hr', 'korisnici/sjohansson.jpg'),
(20, 2, 'philton', '123456', 'Paris', 'Hilton', 'philton@foi.hr', 'korisnici/philton.jpg'),
(21, 2, 'kbeckinsale', '123456', 'Kate', 'Beckinsale', 'kbeckinsale@foi.hr', 'korisnici/kbeckinsale.jpg'),
(22, 2, 'tcruise', '123456', 'Tom', 'Cruise', 'tcruise@foi.hr', 'korisnici/tcruise.jpg'),
(23, 2, 'hduff', '123456', 'Hilary', 'Duff', 'hduff@foi.hr', 'korisnici/hduff.jpg'),
(24, 2, 'ajolie', '123456', 'Angelina', 'Jolie', 'ajolie@foi.hr', 'korisnici/ajolie.jpg'),
(25, 2, 'kknightley', '123456', 'Keira', 'Knightley', 'kknightley@foi.hr', 'korisnici/kknightley.jpg'),
(26, 2, 'obloom', '123456', 'Orlando', 'Bloom', 'obloom@foi.hr', 'korisnici/obloom.jpg'),
(27, 2, 'llohan', '123456', 'Lindsay', 'Lohan', 'llohan@foi.hr', 'korisnici/llohan.jpg'),
(28, 2, 'jdepp', '123456', 'Johnny', 'Depp', 'jdepp@foi.hr', 'korisnici/jdepp.jpg'),
(29, 2, 'kreeves', '123456', 'Keanu', 'Reeves', 'kreeves@foi.hr', 'korisnici/kreeves.jpg'),
(30, 1, 'thanks', '123456', 'Tom', 'Hanks', 'thanks@foi.hr', 'korisnici/thanks.jpg'),
(31, 2, 'elongoria', '123456', 'Eva', 'Longoria', 'elongoria@foi.hr', 'korisnici/elongoria.jpg'),
(32, 2, 'rde', '123456', 'Robert', 'De', 'rde@foi.hr', 'korisnici/rde.jpg'),
(33, 2, 'jheder', '123456', 'Jon', 'Heder', 'jheder@foi.hr', 'korisnici/jheder.jpg'),
(34, 2, 'rmcadams', '123456', 'Rachel', 'McAdams', 'rmcadams@foi.hr', 'korisnici/rmcadams.jpg'),
(35, 2, 'cbale', '123456', 'Christian', 'Bale', 'cbale@foi.hr', 'korisnici/cbale.jpg'),
(36, 1, 'jalba', '123456', 'Jessica', 'Alba', 'jalba@foi.hr', 'korisnici/jalba.jpg'),
(37, 2, 'bpitt', '123456', 'Brad', 'Pitt', 'bpitt@foi.hr', 'korisnici/bpitt.jpg'),
(43, 2, 'apacino', '123456', 'Al', 'Pacino', 'apacino@foi.hr', 'korisnici/apacino.jpg'),
(44, 2, 'wsmith', '123456', 'Will', 'Smith', 'wsmith@foi.hr', 'korisnici/wsmith.jpg'),
(45, 2, 'ncage', '123456', 'Nicolas', 'Cage', 'ncage@foi.hr', 'korisnici/ncage.jpg'),
(46, 2, 'vanne', '123456', 'Vanessa', 'Anne', 'vanne@foi.hr', 'korisnici/vanne.jpg'),
(47, 2, 'kheigl', '123456', 'Katherine', 'Heigl', 'kheigl@foi.hr', 'korisnici/kheigl.jpg'),
(48, 2, 'gbutler', '123456', 'Gerard', 'Butler', 'gbutler@foi.hr', 'korisnici/gbutler.jpg'),
(49, 2, 'jbiel', '123456', 'Jessica', 'Biel', 'jbiel@foi.hr', 'korisnici/jbiel.jpg'),
(50, 2, 'ldicaprio', '123456', 'Leonardo', 'DiCaprio', 'ldicaprio@foi.hr', 'korisnici/ldicaprio.jpg'),
(51, 2, 'mdamon', '123456', 'Matt', 'Damon', 'mdamon@foi.hr', 'korisnici/mdamon.jpg'),
(52, 2, 'hpanettiere', '123456', 'Hayden', 'Panettiere', 'hpanettiere@foi.hr', 'korisnici/hpanettiere.jpg'),
(53, 2, 'rreynolds', '123456', 'Ryan', 'Reynolds', 'rreynolds@foi.hr', 'korisnici/rreynolds.jpg'),
(54, 2, 'jstatham', '123456', 'Jason', 'Statham', 'jstatham@foi.hr', 'korisnici/jstatham.jpg'),
(55, 2, 'enorton', '123456', 'Edward', 'Norton', 'enorton@foi.hr', 'korisnici/enorton.jpg'),
(56, 2, 'mwahlberg', '123456', 'Mark', 'Wahlberg', 'mwahlberg@foi.hr', 'korisnici/mwahlberg.jpg'),
(57, 2, 'jmcavoy', '123456', 'James', 'McAvoy', 'jmcavoy@foi.hr', 'korisnici/jmcavoy.jpg'),
(58, 2, 'epage', '123456', 'Ellen', 'Page', 'epage@foi.hr', 'korisnici/epage.jpg'),
(59, 2, 'mcyrus', '123456', 'Miley', 'Cyrus', 'mcyrus@foi.hr', 'korisnici/mcyrus.jpg'),
(60, 2, 'kstewart', '123456', 'Kristen', 'Stewart', 'kstewart@foi.hr', 'korisnici/kstewart.jpg'),
(61, 2, 'mfox', '123456', 'Megan', 'Fox', 'mfox@foi.hr', 'korisnici/mfox.jpg'),
(62, 2, 'slabeouf', '123456', 'Shia', 'LaBeouf', 'slabeouf@foi.hr', 'korisnici/slabeouf.jpg'),
(63, 2, 'ceastwood', '123456', 'Clint', 'Eastwood', 'ceastwood@foi.hr', 'korisnici/ceastwood.jpg'),
(64, 2, 'srogen', '123456', 'Seth', 'Rogen', 'srogen@foi.hr', 'korisnici/srogen.jpg'),
(65, 2, 'nreed', '123456', 'Nikki', 'Reed', 'nreed@foi.hr', 'korisnici/nreed.jpg'),
(66, 2, 'agreene', '123456', 'Ashley', 'Greene', 'agreene@foi.hr', 'korisnici/agreene.jpg'),
(67, 2, 'zdeschanel', '123456', 'Zooey', 'Deschanel', 'zdeschanel@foi.hr', 'korisnici/zdeschanel.jpg'),
(68, 2, 'dfanning', '123456', 'Dakota', 'Fanning', 'dfanning@foi.hr', 'korisnici/dfanning.jpg'),
(69, 2, 'tlautner', '123456', 'Taylor', 'Lautner', 'tlautner@foi.hr', 'korisnici/tlautner.jpg'),
(70, 2, 'rpattinson', '123456', 'Robert', 'Pattinson', 'rpattinson@foi.hr', 'korisnici/rpattinson.jpg');

--
-- Dumping data for table `izlet`
--

INSERT INTO `izlet` (`izlet_id`, `odrediste`, `opis`, `datum_vrijeme_polaska`, `ukupan_broj_mjesta`, `slika`, `video`, `organiziran`) VALUES
(1, 'New York City', 'New York je savezna država u sjeveroistočnom dijelu SAD-a. Ova država je veliko financijsko i trgovačko središte SAD-a, kao i značajno industrijsko središte. S 19 milijuna stanovnika, država New York je treća najnaseljenija američka savezna država nakon Kalifornije i Teksasa. Država je upravno podijeljena na 62 okruga, a glavni grad je Albany.
Unutar Sjedinjenih Država, New York graniči na jugu sa saveznim državama New Jersey i Pennsylvania, te na istoku s državama Connecticut, Massachusetts i Vermont. Istočno od Long Islanda, država ima morsku granicu s Rhode Islandom, te na sjeveru i zapadu i međunarodnu granicu s Kanadom, tj. pokrajinama Ontario i Québec.', '2018-06-01 08:30:00', 10, 'https://upload.wikimedia.org/wikipedia/commons/b/bb/NYC_Montage_2011.jpg', '', 1),
(2, 'Rim', 'Rim je glavni i najmnogoljudniji grad Italije i ujedno i glavni grad južnotalijanske regije Lacio, grad bogate historije poznat i pod imenom Vječni grad. Rim je centar bogate antičke kulture, od koje je ostalo mnogo spomenika do današnjih dana, a jedan od najvećih je svakako Koloseum. Grad se nalazi u donjem toku rijeke Tiber, u neposrednoj blizini blizu Sredozemnog mora i jedan je od najvećih centara Mediterana. U sklopu gradskog područja Rima nalazi se i Vatikan.', '2018-07-01 10:00:00', 10, 'https://upload.wikimedia.org/wikipedia/commons/7/75/Collage_Rome.jpg', '', 1),
(3, 'Dubrovnik', 'Dubrovnik je grad na jugu Hrvatske. Ime je dobio po hrastovoj šumi, dubravi. Administrativno je središte Dubrovačko-neretvanske županije i jedno od najvažnijih povijesno-turističkih središta Hrvatske. Nalazi se u Južnoj Dalmaciji. Prema popisu iz 2011. godine Dubrovnik je imao 42.615 stanovnika, za razliku od 49.728 stanovnika prema popisu iz 1991. U popisu iz 2011., 90,34% stanovnika izjasnilo se kao Hrvati. Godine 1979. grad Dubrovnik dodan je na UNESCO-ov popis Svjetske baštine. Prosperitet grada Dubrovnika oduvijek se temeljio na pomorskoj trgovini.', '2018-08-01 12:00:00', 10, 'https://upload.wikimedia.org/wikipedia/commons/e/e9/Montage_of_major_Dubrovnik_landmarks.jpg', '', ''),
(4, 'Split', 'Split je najveći grad u Dalmaciji, a drugi po veličini grad u Hrvatskoj. Prema posljednjem popisu stanovništva, provedenom 2011. godine, Split ima 178.192 stanovnika, druga je po veličini hrvatska luka i treća luka na Sredozemlju po broju putnika. Upravno je središte Splitsko-dalmatinske županije i gravitira mu područje triju najjužnijih hrvatskih županija (nekadašnja Zajednica općina Split), te dio Hercegovine, pa i Bosne. U luci Lori na sjevernoj strani poluotoka nalazi se sjedište Hrvatske ratne mornarice. Gradsko središte čini starovjekovna Dioklecijanova palača iz 4. stoljeća (pod UNESCO-vom zaštitom od 1979. godine), što je jedinstven primjer u svijetu. Split je gospodarsko i kulturno središte Dalmacije.', '2018-09-01 14:15:00', 10, 'https://upload.wikimedia.org/wikipedia/commons/f/fe/Split_Collage.jpg', '', ''),
(5, 'Istra', 'Istra je najveće jadransko poluotok. Nalazi se na sjeveroistočnom dijelu Jadrana na teritoriji Slovenije, Hrvatske i Italije. Geografska granica Istre je linija od uvale Muggia nadomak Trsta do uvale Preluka između Opatije i Rijeke. Tako da npr. Opatija je geografski dio Istre. Postoji miješanje pojma Istarski kanton, koji je tek administrativna cjelina i koja obuhvata nešto više od 65% Istre. Zapadna obala Istre je plića i bolje razvedena, dok je istočna strma i slabije naseljena. Istra se obično dijeli na tri dijela: Crvena Istra (zapadna obala), gdje prevladava crveno-smeđa zemlja (crljenica), Siva Istra (središnja Istra), zbog sivog glinenastog tla i Bijela Istra (padine Učke i istočni dio poluotoka) zbog kamenitog tla.', '2018-10-01 16:00:00', 10, 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Limski_kanal_-_sjeverozapad.jpg', '', '');

--
-- Dumping data for table `agencija`
--

INSERT INTO `agencija` (`agencija_id`, `moderator_id`, `naziv`, `opis`) VALUES
(1, 2, 'Varaždin Tours', 'Turistička agencija grada Varaždina'),
(2, 18, 'Abacus', 'Turistička agencija grada Čakovca'),
(3, 30, 'Adria', 'Turistička agencija grada Zagreba');
--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`rezervacija_id`, `agencija_id`, `izlet_id`, `broj_mjesta`) VALUES
(1, 1, 1, 5),
(2, 2, 1, 5),
(3, 1, 2, 3),
(4, 2, 2, 3),
(5, 3, 2, 4),
(6, 1, 3, 3),
(7, 2, 3, 4),
(8, 3, 3, 3),
(9, 1, 4, 4),
(10, 2, 4, 3),
(11, 3, 4, 3),
(12, 1, 5, 3),
(13, 2, 5, 3);

--
-- Dumping data for table `predbiljezba`
--

INSERT INTO `predbiljezba` (`korisnik_id`, `rezervacija_id`, `status`) VALUES
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 0),
(7, 1, 0),
(8, 2, 0),
(9, 2, 0),
(10, 2, 1),
(11, 2, 1),
(12, 2, 1),
(3, 3, 1),
(4, 3, 1),
(5, 3, 1),
(6, 4, 1),
(7, 4, 1),
(8, 4, 0),
(9, 5, 1),
(3, 6, 1),
(4, 7, 0),
(5, 8, 0),
(6, 9, 0),
(7, 10, 0),
(8, 11, 0),
(9, 12, 0),
(10, 13, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
