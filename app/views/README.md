WF : 
sau khi có được data ở controller -> ta sẽ truyền data đó cho (view) -> sau đó view đấy sẽ truyền vào main-layout thông qua hàm ob_start (trong mỗi một cái controller)


main-layout : 
+ Đây là phần renderView cả 3 phần chung của hầu hết các view (footer,header,sidebar).
+ Sau đó nó sẽ renderView của từng view riêng một (Vd : user, cart, book,..) bằng cách gọi tới từng view trong phần /views/parts/*.php thông qua biến $data đã được truyền vào trong từng controller;


