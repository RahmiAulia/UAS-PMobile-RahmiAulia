import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:swalayanmobile/model/api_service.dart';
import 'package:swalayanmobile/model/product.dart';
import 'package:swalayanmobile/screen/cartscreen.dart';

import '../cart_provider.dart';

class DetailScreen extends StatelessWidget {
  final Product product;

  const DetailScreen({
     required this.product,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(product.namaProduk),
        actions: [
          IconButton(
            icon: Icon(Icons.shopping_basket),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => CartScreen(),
                ),
              );
            },
          ),
        ],
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            padding: EdgeInsets.only(bottom: 200), // Memberi ruang untuk tombol di bawah
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Image.network(product.gambarProduk, width: double.infinity, height: 330, fit: BoxFit.contain),
                Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Row(
                    children: [
                      Expanded(
                        child: Text(
                          product.namaProduk,
                          style: TextStyle(
                            fontSize: 28,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                      Text(
                        'Rp${product.harga}',
                        style: TextStyle(
                          fontSize: 18,
                          color: Colors.red,
                        ),
                      ),
                    ],
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Text(
                    product.deskripsi,
                    style: TextStyle(
                      fontSize: 16,
                    ),
                  ),
                ),
              ],
            ),
          ),
          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            child: Container(
              color: Colors.white,
              padding: EdgeInsets.all(16.0),
              child: ElevatedButton.icon(
                onPressed: () async {
                  try {
                    // await ApiService.addToCart(int.parse(product.categoriId));
                    Provider.of<CartProvider>(context, listen: false).addToCart(product);
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(content: Text('Produk berhasil ditambahkan ke keranjang')),
                    );
                  } catch (e) {
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(content: Text('Gagal menambahkan produk ke keranjang')),
                    );
                  }
                },
                icon: Icon(Icons.add_shopping_cart),
                label: Text('Tambahkan ke Keranjang'),
                style: ElevatedButton.styleFrom(
                  primary: Colors.green,
                  minimumSize: Size(double.infinity, 50), // Lebar tombol penuh dan tinggi 50
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}