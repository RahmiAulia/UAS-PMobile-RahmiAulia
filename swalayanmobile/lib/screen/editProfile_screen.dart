import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:swalayanmobile/session.dart';
import '../model/api_service.dart';
import '../model/pengguna.dart';
import 'profile_screen.dart'; // Pastikan untuk mengimpor layar profil Anda

class EditProfileScreen extends StatefulWidget {
  const EditProfileScreen({Key? key}) : super(key: key);

  @override
  State<EditProfileScreen> createState() => _EditProfileScreenState();
}

class _EditProfileScreenState extends State<EditProfileScreen> {
  final ApiService apiService = ApiService();
  final SessionManager sessionManager = SessionManager();

  TextEditingController _nameController = TextEditingController();
  TextEditingController _emailController = TextEditingController();
  TextEditingController _alamatController = TextEditingController();
  TextEditingController _noTeleponController = TextEditingController();

  int? _userId;

  @override
  void initState() {
    super.initState();
    _loadSession();
  }

  Future<void> _loadSession() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _userId = prefs.getInt('userId');
      _nameController.text = prefs.getString('nama') ?? "";
      _emailController.text = prefs.getString('email') ?? "";
      _alamatController.text = prefs.getString('alamat') ?? "";
      _noTeleponController.text = prefs.getString('no_telepon') ?? "";

      // Debugging: print values
      print('UserId: $_userId');
      print('Nama: ${_nameController.text}');
      print('Email: ${_emailController.text}');
      print('Alamat: ${_alamatController.text}');
      print('No Telepon: ${_noTeleponController.text}');
    });
  }

  Future<void> _saveProfile() async {
    if (_userId == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('User ID is not available')),
      );
      return;
    }

    Pengguna pengguna = Pengguna(
      userId: _userId!,
      nama: _nameController.text,
      email: _emailController.text,
      alamat: _alamatController.text,
      noTelepon: _noTeleponController.text,
      password: '', // Assuming password is not being changed here
    );

    try {
      await ApiService.updatePengguna(pengguna);
      // Update the SharedPreferences
      SharedPreferences prefs = await SharedPreferences.getInstance();
      await prefs.setString('nama', _nameController.text);
      await prefs.setString('email', _emailController.text);
      await prefs.setString('alamat', _alamatController.text);
      await prefs.setString('no_telepon', _noTeleponController.text);

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Profile updated successfully')),
      );

      // Navigate to ProfileScreen
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) => ProfileScreen(), // Ganti dengan layar profil Anda
        ),
      );
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Failed to update profile: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Edit Profile'),
        centerTitle: true,
        actions: [
          IconButton(
            icon: Icon(Icons.save),
            onPressed: _saveProfile,
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(25),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              SizedBox(height: 20),
              buildProfileItem('Nama', _nameController, Icons.person),
              buildProfileItem('Email', _emailController, Icons.email),
              buildProfileItem('Alamat', _alamatController, Icons.location_on),
              buildProfileItem('Nomor Telepon', _noTeleponController, Icons.phone_android),
              SizedBox(height: 40),
            ],
          ),
        ),
      ),
    );
  }

  Widget buildProfileItem(String title, TextEditingController controller, IconData icon) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          title,
          textAlign: TextAlign.start,
          style: TextStyle(
            fontSize: 22,
            fontWeight: FontWeight.bold,
          ),
        ),
        SizedBox(height: 5),
        Container(
          padding: EdgeInsets.symmetric(vertical: 10, horizontal: 15),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(10),
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.1),
                spreadRadius: 2,
                blurRadius: 5,
                offset: Offset(0, 3), // changes position of shadow
              ),
            ],
          ),
          child: Row(
            children: [
              Icon(icon, size: 25),
              SizedBox(width: 10),
              Flexible(
                child: TextFormField(
                  controller: controller,
                  style: TextStyle(fontSize: 20),
                  decoration: InputDecoration(
                    border: InputBorder.none,
                  ),
                ),
              ),
            ],
          ),
        ),
        SizedBox(height: 15),
      ],
    );
  }
}
