const ChecksPrivileges = {

    install(Vue, options) {

        Vue.$isAdmin = () => {
            return isAdmin;
        };

        Vue.$moderatesTeams = () => {
            return userModeratedTeams;
        };

        Vue.$canModerateTeam = (teamId) => {

            for (let i = 0; i < userModeratedTeams.length; i++) {
                if (userModeratedTeams[i].team_id === teamId) {
                    return true;
                }
            }

            return false;

        }

    }

};

export default ChecksPrivileges