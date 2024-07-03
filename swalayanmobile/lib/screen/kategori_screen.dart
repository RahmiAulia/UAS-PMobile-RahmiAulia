import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:swalayanmobile/model/product_card.dart';
import 'package:swalayanmobile/model/product.dart';
import 'package:swalayanmobile/model/api_service.dart';
import 'package:swalayanmobile/cart_provider.dart';

class KategoriScreen extends StatefulWidget {
  final int categoryId;

  KategoriScreen({required this.categoryId});

  @override
  _KategoriScreenState createState() => _KategoriScreenState();
}

class _KategoriScreenState extends State<KategoriScreen> {
  late Future<List<Product>> futureProducts;

  @override
  void initState() {
    super.initState();
    futureProducts = ApiService.fetchProductsByCategory(widget.categoryId);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Kategori Produk'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: FutureBuilder<List<Product>>(
          future: futureProducts,
          builder: (context, snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
              return Center(child: CircularProgressIndicator());
            } else if (snapshot.hasError) {
              return Center(child: Text('Error: ${snapshot.error}'));
            } else {
              final products = snapshot.data!;
              print('Products for category ${widget.categoryId}: $products'); // Debug print
              return GridView.builder(
                itemCount: products.length,
                gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                  crossAxisCount: 2,
                  childAspectRatio: 3 / 4,
                  crossAxisSpacing: 10,
                  mainAxisSpacing: 10,
                ),
                itemBuilder: (context, index) {
                  final product = products[index];
                  return ProductCard(
                    product: product,
                  );
                },
              );
            }
          },
        ),
      ),
    );
  }
}
