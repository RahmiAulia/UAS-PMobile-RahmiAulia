  import 'dart:convert';
  import 'package:http/http.dart' as http;
  import 'package:swalayanmobile/config.dart';
  import 'package:swalayanmobile/model/cart_item.dart';
  import 'package:swalayanmobile/model/pengguna.dart';
  import 'package:swalayanmobile/session.dart'; // Perlu diimpor session.dart
  import 'package:swalayanmobile/model/category.dart';
  import 'package:swalayanmobile/model/product.dart';

  class ApiService {
    static Future<List<Product>> fetchProducts({String? keyword}) async {
      String url = '${Config.baseUrl}/produk';

      // Jika ada keyword, tambahkan ke URL sebagai query parameter
      if (keyword != null && keyword.isNotEmpty) {
        url += '?q=$keyword';
      }

      final response = await http.get(Uri.parse(url));
      if (response.statusCode == 200) {
        final List<dynamic> decodedResponse = jsonDecode(response.body)['data'];
        return decodedResponse.map((json) => Product.fromJson(json)).toList();
      } else {
        throw Exception('Failed to load products');
      }
    }

    static Future<List<Product>> fetchProductsByCategory(int categoryId) async {
      final response = await http.get(Uri.parse('${Config.baseUrl}/produk/kategori/$categoryId'));
      if (response.statusCode == 200) {
        final List<dynamic> decodedResponse = jsonDecode(response.body)['data'];
        return decodedResponse.map((json) => Product.fromJson(json)).toList();
      } else {
        throw Exception('Failed to load products for category $categoryId');
      }
    }

    static Future<List<Category>> fetchCategories() async {
      final response = await http.get(Uri.parse('${Config.baseUrl}/kategori_produk'));
      if (response.statusCode == 200) {
        final List<dynamic> decodedResponse = jsonDecode(response.body)['data'];
        return decodedResponse.map((json) => Category.fromJson(json)).toList();
      } else {
        throw Exception('Failed to load categories');
      }
    }

    static Future<List<Product>> searchProducts(String keyword) async {
      final response = await http.get(Uri.parse('${Config.baseUrl}/search?keyword=$keyword'));
      if (response.statusCode == 200) {
        final List<dynamic> decodedResponse = jsonDecode(response.body)['data'];
        return decodedResponse.map((json) => Product.fromJson(json)).toList();
      } else {
        throw Exception('Failed to search products');
      }
    }

      // Fetch all cart items
  static Future<List<CartItem>> fetchCartItems() async {
    final response = await http.get(Uri.parse('${Config.baseUrl}/keranjang'));

    if (response.statusCode == 200) {
      List<dynamic> data = json.decode(response.body);
      if (data == null) {
        throw Exception('Failed to load cart items: data is null');
      }
      return data.map((json) => CartItem.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load cart items');
    }
  }

  // Fetch specific cart item by ID
  Future<CartItem> fetchCartItemById(int id) async {
    final response = await http.get(Uri.parse('${Config.baseUrl}/keranjang/$id'));

    if (response.statusCode == 200) {
      Map<String, dynamic> body = jsonDecode(response.body);
      CartItem cartItem = CartItem.fromJson(body);
      return cartItem;
    } else {
      throw Exception('Failed to load cart item');
    }
  }

  // Add a new cart item
  Future<void> addCartItem(CartItem cartItem) async {
    final response = await http.post(
      Uri.parse('${Config.baseUrl}/keranjang'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode(cartItem.toJson()),
    );

    if (response.statusCode != 200) {
      throw Exception('Failed to add cart item');
    }
  }

  // Add item to existing cart
  Future<void> addItemToCart(int cartId, CartItem cartItem) async {
    final response = await http.post(
      Uri.parse('${Config.baseUrl}/keranjang/$cartId/add-item'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode(cartItem.toJson()),
    );

    if (response.statusCode != 200) {
      throw Exception('Failed to add item to cart');
    }
  }

  // Update cart item
  Future<void> updateCartItem(int id, CartItem cartItem) async {
    final response = await http.put(
      Uri.parse('${Config.baseUrl}/keranjang/$id'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode(cartItem.toJson()),
    );

    if (response.statusCode != 200) {
      throw Exception('Failed to update cart item');
    }
  }

  // Delete cart item
  Future<void> deleteCartItem(int id) async {
    final response = await http.delete(Uri.parse('${Config.baseUrl}/keranjang/$id'));

    if (response.statusCode != 200) {
      throw Exception('Failed to delete cart item');
    }
  }


    // static Future<Pengguna> getPengguna() async {
    //   String? userId = await session.getSessionId(); // Pastikan session.getSessionId() valid
    //   if (userId == null) {
    //     throw Exception('User ID is not available');
    //   }

    //   final response = await http.get(Uri.parse('${Config.baseUrl}/pengguna/$userId'));

    //   if (response.statusCode == 200) {
    //     final responseData = jsonDecode(response.body);
    //     return Pengguna.fromJson(responseData['data']);
    //   } else {
    //     throw Exception('Failed to load pengguna');
    //   }
    // }

    static Future<Pengguna> createPengguna(Pengguna pengguna) async {
      final response = await http.post(
        Uri.parse('${Config.baseUrl}/pengguna'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'id_pengguna':pengguna.userId,
          'nama': pengguna.nama,
          'email': pengguna.email,
          'alamat': pengguna.alamat,
          'password': pengguna.password,
          'no_telepon': pengguna.noTelepon,
        }),
      );

      if (response.statusCode == 201) {
        final responseData = jsonDecode(response.body);
        return Pengguna.fromJson(responseData['data']);
      } else {
        throw Exception('Failed to create pengguna');
      }
    }

    static Future<void> updatePengguna(Pengguna pengguna) async {
      final response = await http.put(
        Uri.parse('${Config.baseUrl}/pengguna/${pengguna.userId}'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'nama': pengguna.nama,
          'email': pengguna.email,
          'alamat': pengguna.alamat,
          'password': pengguna.password,
          'no_telepon': pengguna.noTelepon,
        }),
      );

      if (response.statusCode != 200) {
        throw Exception('Failed to update pengguna');
      }
    }

    static Future<void> deletePengguna(int id) async {
      final response = await http.delete(Uri.parse('${Config.baseUrl}/pengguna/$id'));

      if (response.statusCode != 200) {
        throw Exception('Failed to delete pengguna');
      }
    }

    static Future<Pengguna> login(String email, String password) async {
      final response = await http.post(
        Uri.parse('${Config.baseUrl}/pengguna-login'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'email': email,
          'password': password,
        }),
      );

      if (response.statusCode == 200) {
        final responseData = jsonDecode(response.body);
        return Pengguna.fromJson(responseData['data']);
      } else {
        throw Exception('Failed to login');
      }
    }

  //   // static Future<void> placeOrder(List<CartItem> cartItems, double grandTotal) async {
  //   // List<Map<String, dynamic>> itemsJson = cartItems.map((item) => {
  //   //   'id_produk': item.product.id_produk, // Sesuaikan dengan atribut di model Product Anda
  //   //   'jumlah': item.quantity,
  //   // }).toList();

  //   // final response = await http.post(
  //   //   Uri.parse('${Config.baseUrl}/transaksi'),
  //   //   headers: {'Content-Type': 'application/json'},
  //   //   body: jsonEncode({
  //   //     'id_pengguna': 1, // Ganti dengan ID pengguna yang sesuai jika diperlukan
  //   //     'detail_transaksi': itemsJson,
  //   //     'total_harga': grandTotal,
  //   //   }),
  //   // );

  //   // if (response.statusCode != 201) {
  //   //   throw Exception('Failed to place order');
  //   // }
  // }
  }
