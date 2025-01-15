// City lists
var cities = {
    '': "",
    'Johor': "Batu Pahat|Johor Bahru|Kluang|Kota Tinggi|Kulai/Kulaijaya|Ledang|Muar|Mersing|Nusajaya|Pasir Gudang|Pontian|Segamat",
    'Kedah': "Alor Setar|Baling|Jitra|Kuala Kedah|Kulim|Langkawi|Pendang|Pokok Sena|Sungai Petani|Sik|Yan",
    'Kelantan': "Kota Bharu|Pasir Mas|Tumpat|Pasir Puteh|Bachok|Kuala Krai|Machang|Tanah Merah|Jeli|Gua Musang",
    'Kuala Lumpur': "Kuala Lumpur",
    'Melaka': "Alor Gajah|Bandaraya Melaka|Jasin",
    'Negeri Sembilan': "Jelebu|Jempol|Kuala Pilah|Nilai|Port Dickson|Rembau|Seremban|Seremban 2|Tampin",
    'Pahang': "Bandar Bera|Bentong|Cameron Highlands|Fraser's Hill|Genting Highlands|Jerantut|Kuantan|Kuala Lipis|Kuala Rompin|Maran|Pekan|Raub|Temerloh",
    'Perak': "Batu Gajah|Gerik|Ipoh|Kampar|Kuala Kangsar|Parit Buntar|Seri Iskandar|Seri Manjung|Sitiawan|Tanjung Malim|Tapah|Teluk Intan|Taiping",
    'Perlis': "Arau|Beseri|Chuping|Kaki Bukit|Kangar|Kuala Perlis|Mata Ayer|Padang Besar|Sanglang|Simpang Empat|Wang Kelian",
    'Pulau Pinang': "Balik Pulau|Bukit Mertajam|Kepala Batas|Sg Jawi|Georgetown",
    'Sabah': "Keningau|Kota Kinabalu|Sandakan|Kudat|Tawau|Labuan",
    'Sarawak': "Betong|Bintulu|Kapit|Kuching|Labuan|Limbang|Miri|Mukah|Samarahan|Sarikie|Sibu|Sri Aman",
    'Selangor': "Ampang|Banting|Bangi|Cheras|Kajang|Klang/Port Klang|Kuala Kubu Bharu/Hulu Selangor|Kuala Selangor|Petaling Jaya|Rawang|Sabak Bernam|Selayang|Sepang/Putrajaya|Seri Kembangan|Shah Alam|Subang Jaya",
    'Terengganu': "Jerteh/Kg Raja|Kuala Dungun|Kuala Berang|Kemaman/Chukai|Kuala Nerus|Kuala Terengganu|Marang|Bandar Permaisuri"
};

function print_city(eleID, selectedState, defaultCity) {
    var option_str = document.getElementById(eleID);
    option_str.length = 0;
    option_str.options[0] = new Option('Select City', '');
    var city_arr = cities[selectedState].split("|");
    for (var i = 0; i < city_arr.length; i++) {
        option_str.options[option_str.length] = new Option(city_arr[i], city_arr[i]);
    }
    if (defaultCity) {
        option_str.value = defaultCity;
    }
}