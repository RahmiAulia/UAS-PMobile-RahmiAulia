import 'package:flutter/material.dart';
import 'package:banner_carousel/banner_carousel.dart';
import 'package:swalayanmobile/screen/loginscreen.dart';
import 'package:swalayanmobile/session.dart';
import '../model/category.dart';
import 'kategori_screen.dart';
import '../model/product.dart';
import '../model/api_service.dart';
import 'kategori_screen.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'cartscreen.dart';

class HomeScreen extends StatefulWidget {
  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  late Future<List<Category>> _categoriesFuture;
  String? _userName;

  @override
  void initState() {
    super.initState();
    _categoriesFuture = ApiService.fetchCategories();
    _loadSession();
  }

  Future<void> _loadSession() async {
  SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      _userName = prefs.getString('nama');
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        // title: Text('Hallo, ${_userName ?? "${session.nama}"}'),
        title: Text(
          'Hallo, $_userName',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        automaticallyImplyLeading: false,
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
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            children: [
              TextField(
                decoration: InputDecoration(
                  hintText: 'Search',
                  prefixIcon: Icon(Icons.search),
                  suffixIcon: Icon(Icons.filter_list),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10),
                    borderSide: BorderSide.none,
                  ),
                  filled: true,
                  fillColor: Colors.grey[200],
                ),
              ),
              SizedBox(height: 10),
              BannerCarousel(
                banners: BannerImages.listBanners,
                onTap: (id) => print(id),
              ),
              SizedBox(height: 10),
              FutureBuilder<List<Category>>(
                future: _categoriesFuture,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Error: ${snapshot.error}'));
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('No categories found.'));
                  } else {
                    final categories = snapshot.data!;
                    return GridView.builder(
                      shrinkWrap: true,
                      physics: NeverScrollableScrollPhysics(),
                      itemCount: categories.length,
                      gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                        crossAxisCount: 3,
                        crossAxisSpacing: 10.0,
                        mainAxisSpacing: 10.0,
                      ),
                      itemBuilder: (context, index) {
                        return GestureDetector(
                          onTap: () {
                            print(
                                'Selected category: ${categories[index].id}'); // Debug print
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (context) => KategoriScreen(
                                  categoryId: categories[index].id,
                                ),
                              ),
                            );
                          },
                          child: CategoryCard(category: categories[index]),
                        );
                      },
                    );
                  }
                },
              ),
            ],
          ),
        ),
      ),
      // ),
    );
  }
}

class CategoryCard extends StatelessWidget {
  final Category category;

  const CategoryCard({required this.category});

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Color.fromARGB(255, 97, 212, 87),
        borderRadius: BorderRadius.circular(10.0),
      ),
      child: Center(
        child: Text(
          category.label,
          style: TextStyle(
            color: Colors.white,
            fontSize: 16.0,
            fontWeight: FontWeight.bold,
          ),
          textAlign: TextAlign.center,
        ),
      ),
    );
  }
}

class BannerImages {
  static const String banner1 =
      "https://img.freepik.com/free-vector/hand-drawn-supermarket-facebook-template_23-2150386290.jpg?t=st=1717669721~exp=1717673321~hmac=180ad13e511963516521458e70da79c72da03db8b7c9e0add50623350e397132&w=900";
  static const String banner2 =
      "https://img.freepik.com/free-vector/hand-drawn-supermarket-webinar-template_23-2150386303.jpg?t=st=1717669760~exp=1717673360~hmac=3560a23ab3200eb8e598f82893d4211658b27f7f4a06eaf5f49d11850dc11133&w=900";
  static const String banner3 =
      "https://img.freepik.com/free-vector/hand-drawn-supermarket-sale-banner_23-2150386306.jpg?t=st=1717669768~exp=1717673368~hmac=073b0d1937df0e258d66706abf28e512f3975fbabe1ed35b4c3a5764918a9af1&w=996";
  static const String banner4 =
      "https://img.freepik.com/free-vector/hand-drawn-supermarket-landing-page-template_23-2150386296.jpg?t=st=1717669842~exp=1717673442~hmac=a7a5b9d063d85fea155cd9b79c15e7e46b327768045e506e886152e3ea491ff6&w=900";

  static List<BannerModel> listBanners = [
    BannerModel(imagePath: banner1, id: "1"),
    BannerModel(imagePath: banner2, id: "2"),
    BannerModel(imagePath: banner3, id: "3"),
    BannerModel(imagePath: banner4, id: "4"),
  ];
}
