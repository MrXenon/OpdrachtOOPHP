--
-- Database: `NORCOM`
--
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abonnement` varchar(150) NOT NULL UNIQUE,
  `internetsnelheid` varchar(150) NOT NULL,
  `gbinternet` varchar(150) NOT NULL,
  `belminuten` varchar(150) NOT NULL,
  `sms` varchar(150) NOT NULL,
  `extrakosten` varchar(150) NOT NULL,
  `prijs` varchar(150) NOT NULL,
  `afbeelding` varchar(1024) NOT NULL,
  PRIMARY KEY  (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `abonnement`, `internetsnelheid`, `gbinternet`, `belminuten`, `sms`, `extrakosten`, `prijs`,`afbeelding`) VALUES
('1', 'Onbeperkt', '4G', 'onbeperkt', 'onbeperkt', 'onbeperkt', 'nee', '32.50', 'https://images.pexels.com/photos/47261/pexels-photo-47261.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'),
('2', 'Start 5GB', '4G', '5 GB', 'onbeperkt', 'onbeperkt', 'nee', '24.00', 'https://images.pexels.com/photos/248528/pexels-photo-248528.jpeg?Bauto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
('3', 'Pro 50 GB', '5G', '50 GB', '200', '200', 'nee', '29.50', 'https://images.pexels.com/photos/1092644/pexels-photo-1092644.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mobiele_telefoons`
--

CREATE TABLE IF NOT EXISTS `mobiele_telefoons` (
  `mobiel_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobiel` varchar(150) NOT NULL,
  PRIMARY KEY  (mobiel_id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `mobiele_telefoons`
--

INSERT INTO `mobiele_telefoons` (`mobiel_id`, `mobiel`) VALUES
('1', 'Iphone 11'),
('2', 'Iphone 11 Max Pro');


--
-- Tabelstructuur voor tabel `users`
--
CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `uemail` varchar(70) DEFAULT NULL,
  PRIMARY KEY  (uid))
   ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- INSERT INTO gegevens voor de default user (users tabel)
--

INSERT INTO `users` (`uid`, `uname`,`upass`,`fullname`,`uemail`) VALUES
('1', 'admin','e259dd0015e616aa9772524773820a9c','Admin','support@3dynamisch.nl');