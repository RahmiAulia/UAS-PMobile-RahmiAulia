import 'package:shared_preferences/shared_preferences.dart';

class SessionManager {
  Future<void> saveSession(
      int val, String id, String nama, String email, String alamat, String noTelepon) async {
    SharedPreferences pref = await SharedPreferences.getInstance();
    pref.setInt("value", val);
    pref.setString("id", id);
    pref.setString("nama", nama);
    pref.setString("email", email);
    pref.setString("alamat", alamat);
    pref.setString("no_telepon", noTelepon);
  }

  Future<String?> getSessionId() async {
    SharedPreferences pref = await SharedPreferences.getInstance();
    return pref.getString("id");
  }

  Future<void> clearSession() async {
    SharedPreferences pref = await SharedPreferences.getInstance();
    pref.clear();
  }
}
