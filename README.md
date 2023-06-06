### Hook

Hook adalah kondisi yang akan dipanggil saat bot masuk pada kondisi tertentu, misal saat bot menerima pesan pertama dia akan mencari hook `welcome` atau saat bot merasa tidak tahu akan teks yang dimaksud dari pesan balasan dia akan mencari hook `dont_understand`

| Type Hook | Description |
| -- | -- |
| welcome | akan dipanggil saat ada pesan masuk kali pertama pada 1 sesi |
| custom_condition | Comming Soon |
| dont_understand | akan dipanggil saat bot tidak mengerti apa yang harus dibalas |
| end_chat | akan dipanggil setelah pesan dengan trigger_event *`close_chat`* dikirim |
| confirm_not_response | akan dipanggil saat tidak ada interaksi dari lawan bicara **Type pesan harus bertipe `chat`**  |
| close_chat_not_response | jika pesan dari hook `confirm_not_response` telah dikirim dan tetep tidak ada balasan maka pesan akan langsung ditutup dan hook ini akan dikirim |

### Format Action Reply (Pesan Balasan)

ini adalah format yang akan mengekstraksi teks dari pesan balasan yang akan dianggap valid atau tidak nya sehingga akan membantu bot dalam memutuskan akan menerima jawaban yang diberikan atau tidak.

| Format | Name | Example | Description |
| -- | -- | -- | -- |
| raw text | Fixed | `iya` `ya` `tidak` `1` | berisi teks biasa tanpa format apapun dan akan dianggap valid ketika pesan balasan sama persis |
| {\*} | All | `{*}` | menerima semua pesan balasan dan jika dikombinasikan dengan Fixed format maka, Fixed format akan di cek terlebih dahulu jika tidak cocok maka akan masuk ke format All |
| {!\*} | Not All | `{!*}` | ini sama persis dengan format All namun perbedaannya bot akan menolak menerima jawaban dan hanya mengirim pesan nya saja, (bot akan tetap menunggu sampai jawaban yang valid diterima) |
| {field:*} | get word | `panggil saya {name:*} saja` | ini akan mengambil semua kata di posisi format diletakkan. dalam kasus ini jika ada pesan `panggil saya Jhon saja` maka akan mendapatkan nilai `name: Jhon` |
| {field:n1\|n2\|n3} | get word scoped | `{kabarbaik:ya\|iya\|sehat\|baik} pak` | ini akan mengambil kata-kata yang tersedia di posisi format diletakkan. dalam kasus ini jika ada pesan `sehat pak` maka akan mendapatkan nilai `kabarbaik: sehat` |
| {:location:} | Location | `{:location:}` | hanya menerima balasan pesan lokasi |


