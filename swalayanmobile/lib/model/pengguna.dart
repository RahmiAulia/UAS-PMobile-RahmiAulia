class Pengguna {
  final int userId;
  final String nama;
  final String email;
  final String alamat;
  final String password;
  final String noTelepon;

  Pengguna({
    required this.userId,
    required this.nama,
    required this.email,
    required this.alamat,
    required this.password,
    required this.noTelepon,
  });

  factory Pengguna.fromJson(Map<String, dynamic> json) {
    return Pengguna(
      userId: json['id_pengguna'],
      nama: json['nama'],
      email: json['email'],
      alamat: json['alamat'],
      password: json['password'],
      noTelepon: json['no_telepon'],
    );
  }

}
