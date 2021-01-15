-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2021 at 06:33 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audioCloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `idp` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tp`
--

CREATE TABLE `tp` (
  `idp` int(11) NOT NULL,
  `idt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `idt` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` longblob NOT NULL,
  `filename` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`idt`, `title`, `description`, `image`, `filename`, `userId`) VALUES
(1, 'ddd', 'ddd', 0x89504e470d0a1a0a0000000d49484452000000960000009608060000003c0171e20000131c49444154785eed9d0b548dd9fbc79f13b9fd87864189feb9458629452e352d35a50875e247641cad428af3ef1fcd6f22b17e15a39b34877269d04d1729b9346e5322352e49669ae11f422a341d8dd060f4fed73ed3c929279deaecd37bf2bc6b59cbeaecfdece7f9eecffbbcfbbce77d9fcd013c50010a0a7028d864abc97100300900260080210018004077cacebe02800200b80600f9007019007ea53c262bcc7766b07401c01200cc01600e00a8b24271803700700c00b200e02c00dc64895f7275a3b381f52500d801c02c00182357a5e819fb1d004e00c05100b8406f18c55a567ab076ecd8316ac992258c9a9a5ab162a5c3d13ea480d282f5e9a79f3a575757efc3e965a7024a05d6e8d1a3356fddbae50e002b01a03f3b2595af57a5a5a5fd2c2d2dd7dcba752b0200cae56b9d9e35a502ab77efde4c4d4d8d580da5f2bd3d53181212c27879791113117a7a7affbe71e3c68bf6d853445f659b1c46421465f3bdcdf3a9aeae3efbf1e3c7e49b2439b80090de66630aeaa86c93f351820500d301e0348245efac40b0306351a10bc142b0102c392a809742398a29cd14662ccc58541043b0102c044b8e0ae0a5508e62e2a5f09d02081682454501048b8aacef8ce21a0bd758541043b0102c044b8e0ae0a5508e62e2e21d17ef9471c23516662cca88e11a0bd7585410a302d6a953a7eefcf9e79fa0a6a6a6676d6d2df521baaaaaaa5399999923e7cf9f3fa2b9c82e5dba74e7c183073074e8d05d464646c172540033961cc554d81a8bc7e3fd5e5454a41b151575cbc0c080bc36f6de211008aa626262fa5db97245ea336c0cc37066ce9c5957595909dbb76fdf6a6a6aba4ed208c33023381cce9d36ea8360b5513859bb51c95891919187a2a2a2fe656d6d0d5bb66c910a8e8585c5ebeaea6a55814070d9d8d878725387d3d3d37bfbf9f93debddbb37242626aa6b68683c91352819da21583288d49e2654c0ba73e78ee5c2850bcf70381cb87cf9b254b08c8d8d9957af5ec1a851a32e272424bc07565151912d8fc74b37303080a8a828793f998b60b5871a19fa52018b8c6b6d6dcdfcf1c71f909f9fff1e140f1f3e5cc7e572b7300c43d64f70f8f0e1f7daa4a7a7337e7e7ea0a7a797b27ffffef932c4d29a2608566bd46a435b6a6071b9dcb2d2d252cd8484844ba3468d9a22e95b5454d4a55dbb7691ba0fd0a3470fc8c9c9790f2c5b5b5ba6acac0c22222252264f9e8c60b561723bb20b35b0626262ae8587871bcc9a35ebb19f9f9f866490f6f6f60f1e3c78a03572e448b87dfb36ecddbbf7a0a1a1e162c93613264c607af6ec29153a390886194b0e227ec80435b0cacbcb37d8dadafaf7eddb17ce9c39d32823cd9a358b79f4e811ecdcb9b378d5aa553a13264c38b867cf9e06b0aaaaaaa6585959e5696b6b436a6aaabcd757440f044b59c1227e4f9d3a95210bf8dcdcdc06384a4a4a263b3838fcdcab572f183162c467d7af5faf9a3c7932b9e435b43979f2e4231f1f1f752323a3825dbb76911249f23e102c792bdac41eb58c45c6993d7bf65f151515dd9393932f8e18318254ae21b70ee28383831d5d5d5dc1c8c8a8eff2e5cb9ff6ebd70f4e9f3edd001697cb15969696f6ddbf7f7f819e9e1e82050034d2364db6a882959696f62c2020a0b79d9dddc58d1b378ac09a3b77ee8ff7efdf9f91989858a8a3a333dec9c989f9e5975f203a3ada7fdcb8711b499b69d3a631b5b5b5cddeaa90832098b1e4206287acb1c8a01515150366cf9efd64cc9831101717273ae9783c1e535454046e6e6e9f2d5bb64c989a9afa74f3e6cd9f9a9a9afa6fdfbe7d636565a5a68d8d4d59b76edd988b172faa508a1fc1a224acd82cd58c450621dfeec8a58e2ce07373737b7a7979bd247f3f72e448ef8103073ee7f3f9937273732fd9dbdbc3860d1b3867ce9cc9f1f6f636313333ab090d0ded43297e048b92b00a036be6cc990cf9bdefd0a143d1376edc78e0e7e7e73b77ee5cf0f1f11165b0a2a2a2493c1eefd2b061c32025258563676797f3f0e14393c4c4c41a1d1d1d04ab7ea6708dd5e44c484b4b6302020280cbe5461716160a4b4a4a3cfdfdfd336c6c6c48f949d1b170e142a6b8b81862636317f9fafa26dcbb774fea1d7b399e6498b1e428a63453d42f85f1f1f193b66ddb76c9d4d4b4465555b577666626595f4d5eb66c19a9782c3af6eeddcbecdab50bacacac9cb2b3b30fbc79f3069a7bea414e7a20587212b23933d4c13a7bf6acfab7df7efb484d4d0d0830e45f4a4a4aff21438654899d5abb76ed9273e7cec5e8ebeb4361612198999941686828cdec8f60293b585959595db76ddbf686540e7cf9f2a5089aa0a0a046d014151539f278bc7815151520ff222323c1d0d010c192987c9a62d0608c7ac6224ec7c4c430e1e1e122ff2d2c2cbe0f0a0af2681a8cbdbd3d439e1625c7dcb973357c7c7c1ed308b8de26662c8ae212d30a012b3030706e7272f26132a08b8bcb627777f7834de3dabc7933939a9a0a5dba7421374bfb8f1933a6e152494103048b82a892261502565e5e9ec9ead5ab730834f1f1f1637574747e6b1ad7ead5ab7df3f2f2fc14b0be224323589d012c1203b9d40d1c381076efde2d75b970fdfa755f1717173f4f4fcf1fbffefa6b1bca71235894055648c62231040606ee56555585356bd6b83617938585c56e4343c3a0e0e0e0b6be2421ab5c0896ac4ab5b19dc2c06aa37fb4ba2158b494adb78b60e10bab541043b0102c044b8e0ae0a5508e624a3385190b331615c4102c040bc192a302782994a39878297ca700828560515100c1a222eb3ba3b8c6c2351615c4102c040bc192a302782994a398b878c7c53b659c708d85198b3262b8c6c2351615c4102c040bc192a302782994a398b878c7c53b659c70f18e198b26621c0e8721958beb0f657b27b2cdd2080482d37c3e9fc0455e37e3be7dfb36bdcdc614d451a92647535393292f2fffe8c05ab26409131b1b2b8adbd4d4947be1c205044b9e27c8ecd9b399e3c78f8b4c7ef3cd372f838383ff4b9ef6d968cbdbdb7b68505050495d5d9dc8bd9f7ffe993b65ca14044b9e9315161616e1e9e9e926b6b961c386c2808080f1f21c834db6844261c0a851a37cc8c606e4b0b5b585a3478f2ac55546299c949c6c131313529251f42752e178c89021f0e2c58b12a15028641314edf585d43b2d2b2beb420a939083bce378e2c4092f2b2babd0f6da56447fa5032b3b3bdb60f1e2c5d71e3e7ca8087d58310679d55f20101c737777b76585433238a1746091980a0a0a6cf6ecd97382940feaec07d9bbc7d4d474416c6cec21658a5529c1120b9c9d9dbdc2dbdb1bf2f2f2944973997cd5d5d5251503e1fbefbfdf2353079635526ab058a625ba23a100828538505100c1a2222b1a2560c97b6fbd56a93a7efc78528b0a366ddad4eac5e9f1e3c7e793cd272f5f6e2868dcaab1d9dcf8f3cf3f87e9d3a743787878ab75397ffe3c77fdfaf5aa3939391d1622014bf219a70e7364d2a4493067ce9ce9bebebe675b72a2a0a0c0243e3e3e272424a4a5a64aff39d923d1d8d8787a4c4c4c8bbae4e7e7ebc5c5c51ddebe7dfb4889df543b4403d68045a2efd6ad1bd94f3980c7e3f936a7467676b60e8fc7fbbffbf7ef7788601d3128b98fb577efde146767e766af2e3ffdf4d3e08d1b373e14df3cee083f25c724601d01802f3aca914183060d273f59907aeae4205be3666565994f9d3af59c349fbefcf24b469ce2c99d77b2efcdab57af9e3c7ffefc7947c540635c0d0d8da142a150e5f5ebd722f3e4a43b7ffebcd7942953a4de795fba7429131d1ddde00ad1a5aeae4e585d5d5d4dc3bf166cfec28ac5fb952b57624c4d4d97fcf5d75f227f3d3d3d212c2cec3ddf22232323dcdcdc1a7e2bf4f0f0b81a1e1e6ed401c22964c8a74f9f6e1b3c78b0a7f8679d79f3e649dde83c22226299bbbbfb5eb153eeeeeed51111117d15e2643383b0022ce21b9fcfff9740206858a81616166ae9ebeb37fadd866ce87df4e85151281e1e1e6fc3c3c3bb76a4788a187bf5ead5c376ecd871573c56414101d7c0c0a0d1d30d5e5e5e8c78bde9e8e808070f1eecf079ed7007c482310cd3e5abafbefa3b2b2b4bf427333333ad73e7ce35026bf0e0c1a29de2eb0fd6f84e13308661388e8e8e75090909a261cccdcdb95959598dc0d2d5d5656edebc29fadcdbdbdb70ebd6ad05347d92c536ab26c7d9d9f9fabe7dfbf489e33d7bf6d4aaadad6d04968a8a0a237e2e4909778795653ea4b6110804597c3edfac7eadc57dfdfa7523b0ba74e9c2bc7dfb56d4b7a2a262d8a04183eeb579303975641558e4840380efea63d30280a68f30e0eb5fd25fff629d2e08969cce50ca665a7a9902c16a61023063491708c16ae7998b602158ed44487a77040bc142b0a82880605191153316828560515100c1a2222b662c040bc1a2a20082454556cc58081682454501048b8aac98b1102c048b8a0208161559316321581f17584f9f3e5dca308c2587c349eddbb76f1a95e89b37aafc3f42fff0c30ffa376edc20cf92ab2a583c321ceb32169fcfaf282c2cd478f1e245831ce445054343c3c2c0c04045d5e66205585959593d0402412d798945f2a8abab1b9f96965628f937a9cf63191b1b5f3879f2a47d9f3e7dfea9f8a5b88335605555554d757777cfbd7dfb76b3d1ababab5fc9c8c898a400795801d6fefdfb7becd8b1a3b649bc39f9f9f9a64d35900ad6c489139dd7ae5d3b71d1a245ee0a104d7208d6801514149495949464a6a2a2020b172efcced6d6f63f3a3a3aaf8a8b8b07c4c7c77f77ecd83117e2b8bfbfff511b1b1b3bca3ab10aac418306818b8b8b2b794cbc6bd7aed9767676b764028b34727575cddabd7bb73965c19a9a670558e5e5e5da8e8e8ef76a6a6ac8db40893c1e6f5153477d7c7c4e9d3c79d24a474707121313693f89cb2ab048cdaec3870f7f30e6663f74707008484a4adaf0318275faf4699375ebd6e5f4e9d307323333d5381cceb3a63a949494cc707070f891bcca9e9494a4317cf8f0c714b5ea3c60191818682626262e1a3d7ab4226b5eb22263a5a7a79bf8f9f9e5a8abab43464686d493efead5abaa7c3efff5df7fff0dfbf6edd3f8e28b2f102c8933eb83e96cd5aa55163b77eefc89e299c8ca4b6146468689afaf6f8e9a9a1ac4c5c5696b6a6a3e90a6c1fdfbf793b5b5b51728409fce93b1ea17a63abebebec50a104e3c042b32564545c5587b7bfb5f493d095b5bdbef366ddab45e811a481baa738145222c2d2deda9a5a5d5f42b262d9d590116098e14ed4f4a4a1a4afe3f6ddab4a573e6cc39686e6efe37adc05bb0cb2ab0b4b5b523525353577dc8e716bfcd242727f75cb060c14707566565a5a1a3a363ae5028ec4e042475aacacaca46242424bcd2d2d26a78cf5f41a0b10aace1c3876b1f3a7448eaf240ac478b60294838565d0a25637672727a515454d44bfc6aff279f7c02818181297575753c636363459d70ac014b20106cb876ed5a8b770b102c19cf9c152b5630f9f9f90dadfbf7ef0fb1b1b14e03070e7c57944a465b6d68c61ab0828383eb7efbedb77f8a767de040b05a5248e2735273aa5fbf7ec2e0e060d15fbb77ef0e91919153f4f5f52fb5c24c5b9ab202ace4e4e42e0b162cf8a7fa0882d59204adff3c3f3fff7f3d3c3cc26a6b6b61debc79e5ebd7af1fdc7a2badeac10ab05ae33166acd6a825d1f6c8912391fefefe2bc96f89070e1cf86cecd8b134378942b0da384fac5bbcdfbd7bf7cccd9b370fd8d8d8c43717d38c193398caca4a58b972a5c6f2e5cb3bfd9df7d6cc2d662c296a4d9f3edd442814e6989b9b67848484cc6a4e50070707863c568360bdaf108225851a676767abc2c2c2535c2e177c7d7d9bd5c8dada9a21159f112c044ba66c1e1414649294949443ee59f9f8f8185859595d6fda312c2ccc372e2eceaf6bd7ae101d1ddd475757b74626e36d6b846bacb6e9d6d08b153fe93c7bf6ecb3152b56fc515c5c0c464646409ef4707575ad107b191f1fff6d4c4ccc5692ad9c9c9c6ef3f97c9d76c6dd527704ab25855af89c1560111fdddcdc4c0b0a0ace8b3736b0b4b4146d9ffbe4c91310df28250fbcad59b366a48989c99d76c6dd527704ab258594052ce2676868a8436e6e6ee2bd7b8d8b109397093434347edfb2658b9b9e9e5e763b6396a53b82258b4a1f68c39a8c25e9634141c181bb77ef8a6e8292ad47f4f4f432b5b5b5c5d59ddb19b24cdd112c99646abe112bc16a674cf2e88e60b55345044bba80081682d54e05102c2a0262c642b0102c2a0a20585464c58c85602158541440b0a8c88a190bc142b0a82880605191153316828560515100c1a2222b662c040bc1a2a20082454556cc58081615b01603405cbd65dc6cfc9dc4b2fc087d1e00fe07001a1599a5324b321865dbcb14c4656700f80100102cd9c1229aed9361be15d6848d6091e0bb01400f00685aa29175bbb52b68a65aca580a7243f661d80a5673112058005c0048977d8a3ba62582d531bab7765471c68a00807f03c0bbdd0c5a6b4941ed950aac5ebd7a69be7cf992d49e5f0900fd15a451870f131212f21f2f2fafdd0050dee1cec8e88052812519536565e584010306bc2b582563c0d84c310a282d588a91074769ab0208565b95c37e1f54a03383a50b00960040b66d9903001db19b9934f1df00c03100c80280b30070b33332da99c16a3a5fe30080ecd43501000c01c080547ba43ca9af00a00000ae0100590f5e06805f298fc90af31f1358d204ff6f0020053d860380360090b79d35eabf714e947186ae0200d97eef11009032ddf701e02e00908d173e58b25a46fb4ad9ecff01b6f9aa03018e38c90000000049454e44ae426082, '1_zackvoid_6001d18eaedcb.mp3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idu` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idu`, `username`, `password`) VALUES
(1, 'zackvoid', 'zackvoid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `uP` (`userId`);

--
-- Indexes for table `tp`
--
ALTER TABLE `tp`
  ADD PRIMARY KEY (`idp`,`idt`),
  ADD KEY `tpt` (`idt`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`idt`),
  ADD KEY `uT` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idu`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `uP` FOREIGN KEY (`userId`) REFERENCES `users` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tp`
--
ALTER TABLE `tp`
  ADD CONSTRAINT `tpp` FOREIGN KEY (`idp`) REFERENCES `playlist` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tpt` FOREIGN KEY (`idt`) REFERENCES `track` (`idt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `uT` FOREIGN KEY (`userId`) REFERENCES `users` (`idu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
