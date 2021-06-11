## BriskLimbs Headless
A headless video sharing soultion to adapt to any of your needs

**Note**: This is very initial draft of what this project is going to be. This is far from being useful. But you're welcome to explore :)

### API Endpoints

##### `/videos`
| Method | Endpoint  | Description | Params	| Example	|
| ------------- | ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos | List videos  | `limit`; `sort` id or views; `sort_order` desc, asc  | {host}/videos  |
| **GET** | /videos/search  | Search videos  | `keyword`; all /videos params;  | {host}/videos/search  |
| **GET** | /videos/{video}  | Single video details  | `keyword`; all /videos params;  | {host}/videos/search  |
| **GET** | /videos/{video}/{field}  | Single video details with custom fields  | `keyword`; all /videos params;  | {host}/videos/search  |
| **PUT** | /videos/{video}/edit  | Edit single video  | `keyword`; all /videos params;  | {host}/videos/search  |
| **POST** | /videos  | Upload video  | `keyword`; all /videos params;  | {host}/videos/search  |
| **DELETE** | /videos/{video}  | Delete a video  | `keyword`; all /videos params;  | {host}/videos/search  |
| **GET** | /videos/search  | Search videos  | `keyword`; all /videos params;  | {host}/videos/search  |
