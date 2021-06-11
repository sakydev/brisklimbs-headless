## BriskLimbs Headless
A headless video sharing soultion to adapt to any of your needs

**Note**: This is very initial draft of what this project is going to be. This is far from being useful. But you're welcome to explore :)

### API Endpoints

##### `/videos`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos | List videos  | `limit`; `sort` id or views; `sort_order` desc, asc    
| **GET** | /videos/{video}  | Single video details  | `video`    
| **GET** | /videos/{video}/{field}  | Single video details with custom fields  | `keyword`; all /videos params;    
| **GET** | /videos/search/{keyword}  | Search videos  | `keyword` + all `/videos` params;    
| **PUT** | /videos/{video}/edit  | Edit single video  | fields to update with their values    
| **POST** | /videos/upload  | Upload video  | `file`, `title`, `description`    
| **DELETE** | /videos/{video}  | Delete a video  | `video`    

##### `/users`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /users | List users  | `limit`; `sort` id or total_uploads; `sort_order` desc, asc    
| **GET** | /users/{user}  | Single user details  | `user`    
| **GET** | /users/{user}/{field}  | Single user details with custom fields  | `keyword` + all /users params;    
| **GET** | /users/search/{keyword}  | Search users  | `keyword` + all `/users` params;    
| **PUT** | /users/{user}/edit  | Edit single user  | fields to update with their values    
| **DELETE** | /users/{user}  | Delete a user  | `user`    
| **POST** | /users/register  | Create user  | `username`, `email`, `password`    
| **POST** | /users/login  | Login user  | `username` or `email` + `password`   
