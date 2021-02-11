# Instalasi
1. git clone https://github.com/venussa/Dashboard-Monitoring.git
2. cd Dashboard-Monitoring
3. npm install 
4. npm run serve

Note: Lakukan git clone di dalam /xampp/htdocs/ untuk kepeluan live demo

# Konfigurasi Fake API ( Demo Only )
1. Buka ./src/main.js
2. Pada line 26, ganti isi variable httpApi dengan url API yang digunakan.
3. Pastikan telah terinstall Xampp Control Panel lalu Aktifkan Module Apache dan MySQL
4. Buka Phpmyadmin
5. Buat database bernama test_api dan import file test_api.sql ke dalam database tersebut.
6. Lalu untuk keperluan demo, gunakan alamat url http://localhost/Dashboard-Monitoring/api/ pada httpApi seperti pada Step Sebelumnya.

Note: Pastikan untuk menggunakan xampp dengan Versi PHP dibawah 8.

# Demo Account
1. Admin
- Email : steavenroger@gmail.com
- Pass :inuyasha56
2. Uuser
- Email : pekerja@gmail.com
- Pass : Pekerja

# Struktur File
1. public/
- index.html                           => Main HTML
- Favicon.png                          => Favicon

2. src/@core/
- app-config/                          => pemgaturan modifikasi thenConfig
- assets/                              => pengaturan penggunaan feather icon
- components/                          => komponen komponen inti dari themplate
- mixins/                              => konversi versi dari vue js
- scss/                                => pengaturan tampilan atau design dari themplate
- utils/                               => fungsi validasi untuk input field 

3. src/assets/
- images/photo/                        => menyimpan foto dari user
- images/logo/                         => menyimpan gambar logo
- images/favicon/                      => menyimpan gambar favicon
- images/background/                   => menyimpan gambar background
- scss/                                => menyimpan pengaturan tampilan dari themplate

4. src/libs/i18n                       => pengaturan bahasa dasar yang digunakan

5. src/sidebar/
- index.js                             => pengaturan list menu pada sidebar

6. src/router/
- index.js                             => main file
- pages.js                             => Pengaturan halaman / url

7. src/store/
- app/                                 => module umum
- app-config/                          => Modul pengaturan themplate
- vertical-menu/                       => module pengaturan vertikal menu
- index.js                             => Main file

8. src/views/components/layout/navigation
- module/                              => module pegaturan layout vertical
- LayoutVertical.vue                   => main layout untuk side bar dan navbar
- LayoutVerticalSubMenu.vue            => Layout untuk sidebar
- LayoutVerticalSubMenuContainer.vue   => layout container dari list menu pada side bar
- LayoutVerticalSubMenuList.vue        => list menu
- NavBar.vue                           => layout container dari navbar
- NavDropdown.vue                      => Isi dari navbar

9. src/views/components/layout/pages/
- LayoutContent.vue                    => Container dari dari layout sidebar dan navabr
- LayoutFooter.vue                     => Text Footer
- LayoutFull                           => Container untuk meload dari router

10. src/views/main_page/
- account-setting/                     => halaman pengaturan akun atau profile user ayng sedang login
- authentication/                      => halaman login, register dan forgot password
- dashboard/index.vue                  => main file dashboard
- dashboard/layout-admin/              => halaman dashboard untuk admin
- dashboard/layout-user/               => halaman dashboard untuk user
- notfound/                            => error handling jika halaman yang di tuju tidak ditemukan
- project/index.vue                    => main file dari halaman list project
- project/detail/                      => halaman untuk menampillkan informasi detail dari project
- group/                               => halaman untuk menampilkan informasi detail dari group
- sensor/                              => menampilkan informasi detail dari halaman sensor
- user/index.vue                       => menampilkan list user yang terdaftar dalam system
- add/                                 => halaman untuk menambah user
- edit/                                => halaman untuk merubah data user

11. src/components.js                  => main global component file
12. src/index.vue                      => Main vue file
13. src/main.js                        => Main js file
13. babel.config.js                    => Babel configuration
14. package.json                       => Package json
15. README.md                          => README
16. postcss.config.js                  => postcss configuration
17. jsconfig.json                      => JavaScript language service file [VS Code]
18. .eslintrc.js                       => ESLint Configuration
19. vue.config.js                      => VueJS configuration
20. themeConfig.js                     => Vuexy Admin configuration

# Routing Halaman
Buka ./src/router/ lalu di dalamnya ada 2 file bernama index.js dan pages.js.
index.js adalah main file router yang didalamanya terdapat pemngaturan mengenai page protection
atau halaman yang hanya boleh diakses jika login atau tidak login yang lebih tepatmnya
dapat ditemukan mulai dari line 28.

Lalu untuk mengubah rute url atau url halaman website, anda dapat mengubahnya pada file pages.js 
dan silahkan ikuti pola penulisannya. Berikut penjelasan mengenai fungsi dari tiap paramater didalama file pages.js

- path = struktur url dari halaman
- name = identitas dari router halaman

fungsi dari meta
- title = untuk merubah judul dari tiap halaman yangt di akses, judul tersebut dapat dilihat pada heading tab browser
- requiresAuth = membuat halaman hanya dpat di akses oleh user yang telah terautentikasi ( login )
- hideAuth = membuat halaman hanya dapat diakses untuk user yang belum terautentikasi ( belum login )
- http_url = menyimpan sub url dari API yang di tampung di variable httpApi pada file src/main.js

componenet
- berfungsi untuk mengalamatkan pemanggilan file vue js yang akan di include pada router yang bersangkutan.

# Navigasi
untuk mengubah list menu navigasi pada sidebar, silahkan buka file ./sec/navigation/index.js. silahkan ikuti pola penulisannya dan berikut penejlasan paramater yang ada didalamanya
- title : judul dari menu
- route : name dari router halaman yang di tuju bila di klik
- icon : icon yang akan muncul di sebelah judul menu
- auth : untuk membedakan role user yang boleh milihat menu tersebut (Admin, User, All)

# Autentikasi
Proses ini dilakukan dengan cara user melakukan proses login pada halaman login yang mana halaman tersebut dapat anda temukan pada ./src/views/main_page/authentication/login.vue. Prosesnya menggunakan axios http request terhadapat fake API. Lalu axios response akan di simpan kedalam javascript sessionStorage
- sessionStorage login = menyatakan status user apakah telah login atau belum
- sessionStorage user_data = menampung data user login yang didapat dari axios response

# Pengaturan Akses API
- ganti domain akses api di /src/main.js ( line 25 ) pada variable httpApi
- ganti sub url api dapat dilakuklan pada tiap-tiap route di /src/roter/pages.js pada paramater meta -> http_url. silahkan ikuti format penulisanya.

Contoh:
- alamat api anda http://domain.com/url_proccess 
- maka http://domain.com/ akan di input ke variable httpApi di main.js
- url_proccess akan di input ke meta -> http_url pada router di file pages.js

masukkan data bertipe array pada http_url agar dapat menampung milti sub url
ex: ['url1', 'url2', 'url3', ...]

# Axios API Request
Axios Api Request dapat ditemukan pada bagian vue component di tiap tiap file yang di tuju oleh router. Temukan komentar bertuliskan 
- // Axios Http Api Request

Lalu untuk pengaturan paramater data yang dikirm oleh axios dapat ditemukan pada komentar bertuliskan
- // set paramater data

Lalu untuk alamat pengiriman data atau api urlnya dapat anda konfigurasi pada bagian setelah anda menset paramater data. lebih tepatnya pada variable 
- this.$route.meta.http_url[index_data]

pada bagian index data dapat anda sesuaikan dengan posisi url yang anda setting pada router di file src/router/pages.js.
- contoh: pada router, meta -> http_url router berisi ['url1', 'url2', 'url3'], jika axios ingin mengirimkan data ke url2, maka ganti index_data dengan psosisi data dari si url2 yaitu bernomor index1 (this.$route.meta.http_url[1])

Lalu axios response atau respon balik server saat axios mengirimkan data akan di tampung ek dalam api storage. Dapat di temukan pada komentar bertuliskan
- // set Axios Response to Api storage

Lalu untuk menentukan apakah data yang dikirim pmendapat responses true atau false dari server. dapat ditumukan pada bagian program dengan komentar bertulisakan
- // complete Axios Http Api Request

# Struktur response data dari API
Response data yang diterima axios dari server akan berjenis data JSON object dengan struktur dasar sebagai berikut

- result = true / false
Object ini untuk memberitahukan axios apakah prosesnya sudah sesuai atau tidak. True jika berhasil false jika gagal. Segaai contoh sat anda melakukan login. Maka jika True maka login berhasil dan sebaliknya. Hal ini bisa terjadi mungkin akrena email yang anda input salah atau email tidak sesui format yang berlaku.

- msg = "Message text"
Object ini untuk menampilkan pesan untuk menindak lanjuti dari result. Msg akan digunakan slah satunya untuk alert atau peringatan saat melakukan proses request oleh axios. Sebagai contoh saat anda melakukan login dan mendapat pesan password anda salah.

- Object = List Data (optional)
Object ini adalah bagian yang menampilakn hasil dari request yang diminta. sebagai contoh saat pada bagian user management maka list user tersebut akan di tampung pada paramater Obnject ini.

- other (optional)
Ini adalah object tambahn untuk menyesuaikan dengan kebutuhan lainnya.

# Identifikasi data pada input field
- Data yang di input pada input field akan dikirim ke variable tertentu yang sudah di definiskan pada data(){ return{...}} dengan trigger pada html attribute yaitu v-model.
- contoh: input field < input-field v-model="username">, maka username harus terdefinisi pada data(){ return{ username, var2, var3, ...}} lalu variable username dapat anda gunakan untuk dikirim ke server dengan axios dengan menambahkan paramater form data baru pada komentar // set paramater data .

# Pengiriman data dari file induk
adlah metode pengiriman data dari file utama ke anak file yang di paggil ke file utama. contoh:
- pada file utama ada tag berama < tag-name :datakirim="variable_data" />. Berarti file utama ingin mengirim data ke file yang di include didalam <tag-name>
- lalu pada file anak, buatlah penerima dengan menggunakan props: { datakirim } yang mana file anak akan membaca ulang data yang dikirim dari file utama yang disimpan didalam variable datakirim.
  
# Data validasi
Lakukan pada backend dengan reegular expresion.

# Tata letak file berdasarkan halaman
- Halaman login => src/view/main_page/authentication/login.vue
- Halaman register => src/view/main_page/authentication/register.vue
- Halaman forgot password => src/view/main_page/authentication/forgot.vue
- Halaman dashboard untuk role admin => src/view/main_page/dashboard/layout-admin/
- Halaman dashboard untuk role user => src/view/main_page/dashboard/layout-user/
- Halaman account setting => src/view/main_page/account-setting
- halaman user list => src/view/main_page/user/index.vue
- Halaman user add => src/view/main_page/user/add/
- Halaman user edit => src/view/main_page/user/edit/
- Halaman list project => src/view/main_page/project/
- Halaman list group => src/view/main_page/project/detail/
- Halaman list node dan sensor => src/view/main_page/project/group/
- Halaman sensor detail => src/view/main_page/project/sensor/

# Catatan
- source code sudah dilengkapi dengan komentar guna membantu dalam memahami dan pengembangan
- demo only : jika http_url pada router mengarah pada "req_userlist", maka file yang di tuju adalah Darshboard-Monitoring/api/proccess/req_userlist.php
- Jika mengalami kendala saat melakukan npm install, dependensi bisa di download melalui link berikut https://drive.google.com/file/d/1E_ebvVBjoirMZyPYam5V55rCMREzX4vO/view?usp=sharing
