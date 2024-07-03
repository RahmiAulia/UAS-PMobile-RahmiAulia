import 'package:circle_nav_bar/circle_nav_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:swalayanmobile/home.dart';
import 'package:swalayanmobile/screen/history_screen.dart';
import 'package:swalayanmobile/screen/homescreen.dart';
import 'package:swalayanmobile/screen/kategori_screen.dart';
import 'package:swalayanmobile/screen/loginscreen.dart';
import 'package:swalayanmobile/screen/registerscreen.dart';
import 'package:swalayanmobile/screen/profile_screen.dart';
import 'package:swalayanmobile/splashscreen.dart';

import 'cart_provider.dart';

void main() {
  runApp(
    MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (context) => CartProvider()),
      ],
      child: MyApp(),
    ),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(
        primarySwatch: Colors.green,
      ),
      home: SplashScreen(),
      debugShowCheckedModeBanner: false,
    );
  }
}

class Navbar extends StatefulWidget {
  const Navbar({Key? key}) : super(key: key);

  @override
  State<Navbar> createState() => _Navbar();
}

class _Navbar extends State<Navbar> with SingleTickerProviderStateMixin {
  int _tabIndex = 1;
  int get tabIndex => _tabIndex;
  set tabIndex(int v) {
    _tabIndex = v;
    setState(() {
      HomeScreen();
    });
  }

  late PageController pageController;

  @override
  void initState() {
    super.initState();
    pageController = PageController(initialPage: _tabIndex);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBody: true,
      bottomNavigationBar: CircleNavBar(
        activeIcons: const [
          Icon(Icons.history, color: Colors.greenAccent),
          Icon(Icons.home, color: Colors.greenAccent),
          Icon(Icons.favorite, color: Colors.greenAccent),
        ],
        inactiveIcons: const [
          Text("riwayat"),
          Text("Home"),
          Text("profile"),
        ],
        color: Colors.white,
        height: 60,
        circleWidth: 60,
        activeIndex: tabIndex,
        onTap: (index) {
          tabIndex = index;
          pageController.jumpToPage(tabIndex);
        },
        padding: const EdgeInsets.only(left: 16, right: 16, bottom: 20),
        cornerRadius: const BorderRadius.only(
          topLeft: Radius.circular(8),
          topRight: Radius.circular(8),
          bottomRight: Radius.circular(24),
          bottomLeft: Radius.circular(24),
        ),
        shadowColor: Colors.greenAccent,
        elevation: 10,
      ),
      body: PageView(
        controller: pageController,
        onPageChanged: (v) {
          tabIndex = v;
        },
        children: [
          HistoryScreen(),
          HomeScreen(),
          ProfileScreen(),
        ],
      ),
    );
  }
}
