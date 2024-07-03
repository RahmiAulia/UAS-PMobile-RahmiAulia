import 'package:swalayanmobile/model/product.dart';

class CartItem {
  final Product product;
  int quantity;

  CartItem({
    required this.product,
    this.quantity = 1,
  });

  factory CartItem.fromJson(Map<String, dynamic> json) {
    return CartItem(
      product: Product.fromJson(json['produk']),
      quantity: json['jumlah'],
    );
  }


  Map<String, dynamic> toJson() {
    return {
      'produk': product.toJson(),
      'jumlah': quantity,
    };
  }
}
