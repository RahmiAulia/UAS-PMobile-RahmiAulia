class UnbordingContent {
  String title;
  String image;
  String desc;

  UnbordingContent(
      {required this.title, required this.image, required this.desc});
}

List<UnbordingContent> contents = [
  UnbordingContent(
      title: 'Belanja Praktis',
      image: 'lib/images/belanja.svg',
      desc: "Belanja mudah dan praktis hanya dengan handphone"),
  UnbordingContent(
      title: 'Kualitas Terjamin',
      image: 'lib/images/kualitas.svg',
      desc: "Kulitas produk terjamin dan terjaga dengan baik"),
  UnbordingContent(
      title: 'Beragam Kategori',
      image: 'lib/images/kategori.svg',
      desc: "Tersedia berbagai macam kategori untuk bermacam kebutuhan")
];
