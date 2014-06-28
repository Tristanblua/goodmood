http://blog.tankist.de/blog/2013/07/17/oauth2-explained-part-2-setting-up-oauth2-with-symfony2-using-fosoauthserverbundle/


 php app/console acme:oauth-server:client:create --redirect-uri="http://clinet.local/" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"


  /*

    /oauth/v2/token?client_id=6_62yxhdac42gwcck0wk8kk4ks84wswgk44ko4cg4wsw4c4sowsk&client_secret=maqa75e9hyoooc008cg8ccc4s4gco8w80occo8gsg4cs0o000&grant_type=password&username=toto&password=toto01
    */