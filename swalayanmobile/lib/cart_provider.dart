import 'package:flutter/material.dart';
import 'package:swalayanmobile/model/product.dart';
import 'package:swalayanmobile/model/cart_item.dart';

class CartProvider with ChangeNotifier {
  final List<CartItem> _items = [];

  List<CartItem> get items => _items;

  void addToCart(Product product) {
    final index = _items.indexWhere((item) => item.product.namaProduk == product.namaProduk);

    if (index != -1) {
      _items[index].quantity += 1;
    } else {
      _items.add(CartItem(product: product, quantity: 1));
    }

    notifyListeners();
  }

  void removeFromCart(Product product) {
    final index = _items.indexWhere((item) => item.product.namaProduk == product.namaProduk);

    if (index != -1 && _items[index].quantity > 1) {
      _items[index].quantity -= 1;
    } else {
      _items.removeAt(index);
    }

    notifyListeners();
  }

  int get totalItems => _items.length;

  double get totalAmount {
    double total = 0.0;
    for (var item in _items) {
      total += double.parse(item.product.harga) * item.quantity;
    }
    return total;
  }
}
