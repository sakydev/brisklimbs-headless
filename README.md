## BriskLimbs Headless
A headless video sharing soultion to adapt to any of your needs

**Note**: This is very initial draft of what this project is going to be. This is far from being useful. But you're welcome to explore :)

### API Endpoints

| Method | Endpoint  | Description | Params	| Example	|
| ------------- | ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos | List videos  | `limit`; `sort` id or views; `sort_order` desc, asc  | {host}/videos  |
| **GET** | /videos/{video}  | Single video details  | `keyword`; all /videos params;  | {host}/videos/search  |
| **GET** | /videos/{video}/{field}  | Single video details with custom fields  | `keyword`; all /videos params;  | {host}/videos/search  |
| **GET** | /videos/search/{keyword}  | Search videos  | `keyword` + all `/videos` params;  | {host}/videos/search/{keyword}  |
| **PUT** | /videos/{video}/edit  | Edit single video  | fields to update with their values  | {host}/videos/{video}/edit  |
| **POST** | /videos  | Upload video  | `file`, `title`, `description`  | {host}/videos  |
| **DELETE** | /videos/{video}  | Delete a video  | `video`  | {host}/videos/{video}  |
| **GET** | /videos/search  | Search videos  | `keyword`; all /videos params;  | {host}/videos/search  |
