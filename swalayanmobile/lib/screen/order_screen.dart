import 'package:flutter/material.dart';
import 'package:swalayanmobile/model/api_service.dart';
import 'package:swalayanmobile/model/cart_item.dart';

class OrderScreen extends StatefulWidget {
  const OrderScreen({Key? key}) : super(key: key);

  @override
  State<OrderScreen> createState() => _OrderScreenState();
}

class _OrderScreenState extends State<OrderScreen> {
  late Future<List<CartItem>> _cartItemsFuture;

  @override
  void initState() {
    super.initState();
    _cartItemsFuture = ApiService.fetchCartItems();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Rincian Pesanan'),
      ),
      body: FutureBuilder<List<CartItem>>(
        future: _cartItemsFuture,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return Center(child: Text('Keranjang kosong'));
          } else {
            final orderItems = snapshot.data!;
            double shippingCost = 20000; // Example shipping cost
            int totalItems = 0;
            double totalPrice = 0;

            // Debugging log
            for (var item in orderItems) {
              print('Item: ${item.product.namaProduk}, Quantity: ${item.quantity}, Harga: ${item.product.harga}');
              totalItems += item.quantity;
              totalPrice += item.quantity * double.parse(item.product.harga);
            }

            double grandTotal = totalPrice + shippingCost;

            return Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Detail Pemesanan',
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                  SizedBox(height: 10),
                  Expanded(
                    child: ListView.builder(
                      shrinkWrap: true,
                      itemCount: orderItems.length,
                      itemBuilder: (context, index) {
                        final item = orderItems[index];
                        return ListTile(
                          title: Text(item.product.namaProduk),
                          trailing: Text('${item.quantity} x Rp${item.product.harga}'),
                        );
                      },
                    ),
                  ),
                  SizedBox(height: 20),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text('Biaya Pengiriman'),
                      Text('Rp${shippingCost.toStringAsFixed(2)}'),
                    ],
                  ),
                  Divider(thickness: 2, height: 30),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text('Total Produk'),
                      Text('$totalItems'),
                    ],
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text('Total Harga'),
                      Text('Rp${totalPrice.toStringAsFixed(2)}'),
                    ],
                  ),
                  SizedBox(height: 20),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Text(
                        'Total Harga Pemesanan',
                        style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                      ),
                      Text(
                        'Rp${grandTotal.toStringAsFixed(2)}',
                        style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                            color: Colors.red),
                      ),
                    ],
                  ),
                  Spacer(),
                  ElevatedButton(
                    onPressed: () async {
                      // Logic for placing the order
                      // This could include sending the order to a backend server or storing locally
                      ScaffoldMessenger.of(context).showSnackBar(
                        SnackBar(content: Text('Pesanan Dibuat!')),
                      );
                    },
                    child: Text('Buat Pesanan'),
                    style: ElevatedButton.styleFrom(
                      minimumSize: Size(
                          double.infinity, 50), // Memenuhi lebar layar dan tinggi 50
                    ),
                  ),
                ],
              ),
            );
          }
        },
      ),
    );
  }
}
