<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="informe_id" wizardTheme="InLine" wizardThemeType="File" defaultValue="CCGetParam(&quot;informe_id&quot;,&quot;&quot;)">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="alt_informe_id" wizardTheme="InLine" wizardThemeType="File" defaultValue="CCGetParam(&quot;informe_id&quot;,&quot;&quot;)">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Label>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="informes" connection="Datos" pageSizeLimit="100" wizardCaption="Lista de Informes " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" dataSource="informes" PathID="informes">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_informe" fieldSource="nom_informe" wizardCaption="Nom Informe" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="qty_grupo" wizardTheme="Inline" wizardThemeType="File" defaultValue="'0'" hrefSource="#" visible="Yes" PathID="informesqty_grupo">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="61"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters>
						<LinkParameter id="63" sourceType="DataField" name="informe_id" source="informe_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="5" conditionType="Parameter" useIsNull="False" field="informe_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="informe_id" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="59" tableName="informes" posWidth="100" posHeight="100" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="60" tableName="informes" fieldName="*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="52" variable="informe_id" parameterType="URL" dataType="Integer" parameterSource="informe_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="10" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="NewRecord1" wizardTheme="InLine" wizardThemeType="File" actionPage="elim_informe" errorSummator="Error" wizardFormMethod="post" connection="Datos" dataSource="informes" activeCollection="TableParameters" activeTableType="dataSource" PathID="NewRecord1">
			<Components>
				<Link id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="qty_test" wizardTheme="InLine" wizardThemeType="File" fieldSource="qty" hrefSource="#" visible="Yes" PathID="NewRecord1qty_test">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="62"/>
							</Actions>
						</Event>
					</Events>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_informe" wizardTheme="InLine" wizardThemeType="File" fieldSource="nom_informe">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="informe_id" wizardTheme="InLine" wizardThemeType="File" PathID="NewRecord1informe_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="11" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="nuevo_informe_id" wizardTheme="None" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="informes" boundColumn="informe_id" textColumn="nom_informe" activeCollection="TableParameters" activeTableType="dataSource" visible="Yes" PathID="NewRecord1nuevo_informe_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="informe_id" dataType="Integer" searchConditionType="NotEqual" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="informe_id" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="72" tableName="informes" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="informe_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="informe_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="21" variable="informe_id" parameterType="URL" dataType="Integer" parameterSource="informe_id" defaultValue="0"/>
			</SQLParameters>
			<JoinTables>
				<JoinTable id="36" tableName="informes" posWidth="215" posHeight="316" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="37" tableName="informes" alias="informes_informe_id" fieldName="informes.informe_id"/>
				<Field id="38" tableName="informes" fieldName="nom_informe"/>
			</Fields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="elim_informe_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="elim_informe.php" comment="//" codePage="utf-8" forShow="True" url="elim_informe.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="66" groupID="16"/>
		<Group id="67" groupID="17"/>
		<Group id="68" groupID="18"/>
		<Group id="69" groupID="19"/>
		<Group id="70" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="9"/>
			</Actions>
		</Event>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="71"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
