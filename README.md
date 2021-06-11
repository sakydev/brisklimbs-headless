## BriskLimbs Headless
A headless video sharing soultion to adapt to any of your needs

**Note**: This is very initial draft of what this project is going to be. This is far from being useful. But you're welcome to explore :)

### API Endpoints

| Method | Endpoint  | Description | Params	| Example	|
| ------------- | ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos | List videos  | `limit`; `sort` id or views; `sort_order` desc, asc  | {host}/videos  |
| **GET** | /videos/{video}  | Single video details  | `video`  | {host}/videos/{video}  |
| **GET** | /videos/{video}/{field}  | Single video details with custom fields  | `keyword`; all /videos params;  | {host}/videos/{video}  |
| **GET** | /videos/search/{keyword}  | Search videos  | `keyword` + all `/videos` params;  | {host}/videos/search/{keyword}  |
| **PUT** | /videos/{video}/edit  | Edit single video  | fields to update with their values  | {host}/videos/{video}/edit  |
| **POST** | /videos/upload  | Upload video  | `file`, `title`, `description`  | {host}/videos  |
| **DELETE** | /videos/{video}  | Delete a video  | `video`  | {host}/videos/{video}  |
| **GET** | /users | List users  | `limit`; `sort` id or total_uploads; `sort_order` desc, asc  | {host}/users  |
| **GET** | /users/{user}  | Single user details  | `user`  | {host}/users/{user}  |
| **GET** | /users/{user}/{field}  | Single user details with custom fields  | `keyword` + all /users params;  | {host}/users/{user}  |
| **GET** | /users/search/{keyword}  | Search users  | `keyword` + all `/users` params;  | {host}/users/search/{keyword}  |
| **PUT** | /users/{user}/edit  | Edit single user  | fields to update with their values  | {host}/users/{user}/edit  |
| **DELETE** | /users/{user}  | Delete a user  | `user`  | {host}/users/{user}  |
| **POST** | /users/register  | Create user  | `username`, `email`, `password`  | {host}/users/register  |
| **POST** | /users/login  | Login user  | `username` or `email` + `password`  | {host}/users/login  |
