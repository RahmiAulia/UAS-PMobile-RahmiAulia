class Product {
  final String categoriId;
  final String namaProduk;
  final String harga;
  final String gambarProduk;
  final String deskripsi;

  Product({
    required this.categoriId,
    required this.namaProduk,
    required this.harga,
    required this.gambarProduk,
    required this.deskripsi,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      categoriId: json['id_kategori'].toString(),
      namaProduk: json['nama_produk'] ?? '',
      harga: json['harga'] ?? '',
      gambarProduk: json['gambar_produk'] ?? '',
      deskripsi: json['deskripsi'] ?? '',
    );
  }


  toJson() {}
}
